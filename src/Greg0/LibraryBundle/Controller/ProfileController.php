<?php
/**
 * Created by PhpStorm.
 * User: Grego
 * Date: 21.01.2017
 * Time: 20:02
 */

namespace Greg0\LibraryBundle\Controller;


use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Greg0\LibraryBundle\Entity\Author;
use Greg0\LibraryBundle\Entity\Book;
use Greg0\LibraryBundle\Entity\User;
use Greg0\LibraryBundle\Form\AuthorType;
use Greg0\LibraryBundle\Form\BookType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

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
            throw $this->createNotFoundException('Book does not exists');
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
            throw $this->createNotFoundException('Book does not exists');
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

    public function createBookAction(Request $request = null)
    {
        $book = new Book();
        $author = new Author();
        $bookForm = $this->createForm(BookType::class, $book);
        $authorForm = $this->createForm(AuthorType::class, $author);
        if ($request->isMethod('POST'))
        {
            $bookForm->handleRequest($request);
            $authorForm->handleRequest($request);

            if ($bookForm->isSubmitted() && $bookForm->isValid())
            {
                /** @var Book $book */
                $book = $bookForm->getData();

                $em = $this->getDoctrine()->getManager();
                $em->persist($book);
                $em->flush();

                $this->addFlash('success', $this->get('translator')->trans('user_message.book_created',
                    ['title' => $book->getTitle()], 'LibraryBundle'));

                return $this->redirectToRoute('profile_create_book');
            }
            elseif ($authorForm->isSubmitted() && $authorForm->isValid())
            {
                /** @var Author $author */
                $author = $authorForm->getData();

                $em = $this->getDoctrine()->getManager();
                $em->persist($author);
                $em->flush();

                $this->addFlash('success', $this->get('translator')->trans('user_message.author_created',
                    ['fullname' => $author->getFullName()], 'LibraryBundle'));
                return $this->redirectToRoute('profile_create_book');
            }
        }

        return $this->render('@Library/Profile/create_book.html.twig', [
            'form' => $bookForm->createView(),
            'authorForm' => $authorForm->createView(),
        ]);
    }

    public function userLibraryAction($userId)
    {
        /** @var User $user */
        $user = $this->getDoctrine()->getRepository('LibraryBundle:User')->find($userId);
        if (is_null($user))
        {
            throw $this->createNotFoundException('User does not exists');
        }
        $books = $user->getBooks();

        $header = $this->get('translator')->trans('page_header.user_library', ['fullname' => $user->getFullName()], 'LibraryBundle');

        return $this->render('LibraryBundle:Book:index.html.twig', [
            'header' => $header,
            'books' => $books,
        ]);

    }
}