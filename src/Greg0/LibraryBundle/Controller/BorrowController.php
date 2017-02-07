<?php

namespace Greg0\LibraryBundle\Controller;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Greg0\LibraryBundle\Entity\Book;
use Greg0\LibraryBundle\Entity\Borrow;
use Greg0\LibraryBundle\Entity\User;
use Greg0\LibraryBundle\Util\RequestStateChanger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BorrowController extends Controller
{
    /**
     * @return User
     */
    private function getLoggedUser()
    {
        return $this->container->get('security.token_storage')->getToken()->getUser();
    }


    public function requestBookAction($userId, $bookId)
    {
        /** @var User $targetUser */
        $targetUser = $this->getDoctrine()->getRepository('LibraryBundle:User')->find($userId);
        /** @var Book $book */
        $book       = $this->getDoctrine()->getRepository('LibraryBundle:Book')->find($bookId);
        $loggedUser = $this->getLoggedUser();

        if (is_null($book) || is_null($targetUser))
        {
            throw $this->createNotFoundException('');
        }

        if ($book->hasUser($targetUser) == false)
        {
            return $this->createAccessDeniedException('This user are not owner of the book');
        }

        $borrow = new Borrow();
        $borrow->setBook($book);
        $borrow->setRequestUser($loggedUser);
        $borrow->setTargetUser($targetUser);
        $borrow->setStatus(Borrow::STATUS_WAITING);
        $borrow->setIsArchived(false);

        try
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($borrow);
            $manager->flush();
        } catch (\Exception $e)
        {
            $this->addFlash('warning', $this->get('translator')->trans('user_message.book_already_requested',
                ['title' => $book->getTitle()], 'LibraryBundle'));

            return $this->redirectToRoute('book_show', ['id' => $bookId]);
        }

        $this->addFlash('success', $this->get('translator')->trans('user_message.book_requested',
            ['title' => $book->getTitle()], 'LibraryBundle'));

        return $this->redirectToRoute('book_show', ['id' => $bookId]);
    }

    public function changeStatusAction($requestId, $status)
    {
        /** @var Borrow $borrow */
        $borrow       = $this->getDoctrine()->getRepository('LibraryBundle:Borrow')->find($requestId);
        $loggedUser = $this->getLoggedUser();

        if (is_null($borrow))
        {
            throw $this->createNotFoundException('');
        }

        $stateChanger = new RequestStateChanger($borrow, $this->getDoctrine()->getManager());
        $result = $stateChanger->changeStateTo($loggedUser, $status);

        if ($result)
        {
            $this->addFlash('success', $this->get('translator')->trans('user_message.request_status_changed', [], 'LibraryBundle'));
        }
        else
        {
            $this->addFlash('warning', $this->get('translator')->trans('common.no_privileges', [], 'LibraryBundle'));
        }
        if ($borrow->getRequestUser()->getId() == $loggedUser->getId())
        {
            return $this->redirectToRoute('profile_borrows');
        }

        return $this->redirectToRoute('profile_requests');

    }
}