<?php
/**
 * Created by PhpStorm.
 * User: Grego
 * Date: 21.01.2017
 * Time: 20:02
 */

namespace Greg0\LibraryBundle\Controller;


use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Greg0\LibraryBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;

class ProfileController extends Controller
{
    /**
     * @return User
     */
    private function getLoggedUser()
    {
        return $this->container->get('security.token_storage')->getToken()->getUser();
    }

    public function libraryAction()
    {
        $loggedUser = $this->getLoggedUser();
        $books      = $this->getDoctrine()->getRepository('LibraryBundle:Book')->findForUser($loggedUser);

        return $this->render('@Library/Profile/library.html.twig', [
            'books' => $books,
        ]);
    }

    public function addBookAction($bookId)
    {
        $loggedUser = $this->getLoggedUser();
        $book       = $this->getDoctrine()->getRepository('LibraryBundle:Book')->find($bookId);

        if (is_null($book))
        {
            return $this->createNotFoundException('Book does not exists');
        }

        try
        {
            $loggedUser->addBook($book);
            $this->container->get('fos_user.user_manager')->updateUser($loggedUser);
        } catch (UniqueConstraintViolationException $e)
        {
            return $this->redirectToRoute('book_index');
        }

        $this->addFlash('success', $this->get('translator')->trans('user_message.book_added',
            ['title' => $book->getTitle()], 'LibraryBundle'));

        return $this->redirectToRoute('profile_library');
    }

    public function removeBookAction($bookId)
    {
        $loggedUser = $this->getLoggedUser();
        $book       = $this->getDoctrine()->getRepository('LibraryBundle:Book')->find($bookId);

        if (is_null($book))
        {
            return $this->createNotFoundException('Book does not exists');
        }

        try
        {
            $loggedUser->removeBook($book);
            $this->container->get('fos_user.user_manager')->updateUser($loggedUser);
        } catch (\Exception $e)
        {
            return $this->redirectToRoute('profile_library');
        }

        $this->addFlash('success', $this->get('translator')->trans('user_message.book_removed',
            ['title' => $book->getTitle()], 'LibraryBundle'));

        return $this->redirectToRoute('profile_library');
    }

    public function myBorrowsAction()
    {
        $loggedUser = $this->getLoggedUser();
        $requests   = $this->getDoctrine()->getRepository('LibraryBundle:Borrow')->findAllForRequestUser($loggedUser);

        return $this->render('@Library/Profile/requests_outgoing.html.twig', [
            'requests' => $requests,
            'menu_selected' => 'borrows'
        ]);
    }

    public function incomingBorrowsAction()
    {
        $loggedUser = $this->getLoggedUser();
        $requests   = $this->getDoctrine()->getRepository('LibraryBundle:Borrow')->findAllForTargetUser($loggedUser);

        return $this->render('@Library/Profile/requests_outgoing.html.twig', [
            'requests' => $requests,
            'menu_selected' => 'requests'
        ]);
    }
}