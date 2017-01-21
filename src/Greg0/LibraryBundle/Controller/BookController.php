<?php

namespace Greg0\LibraryBundle\Controller;

use Greg0\LibraryBundle\Entity\Book;
use Greg0\LibraryBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BookController extends Controller
{
    public function indexAction()
    {
        $books = $this->getDoctrine()->getRepository('LibraryBundle:Book')->findAll();

        return $this->render('LibraryBundle:Book:index.html.twig', [
            'books' => $books
        ]);
    }

    public function showAction($id = null)
    {
        /** @var Book $book */
        $book = $this->getDoctrine()->getRepository('LibraryBundle:Book')->find($id);

        if (is_null($book)) {
            throw $this->createNotFoundException('The book does not exist');
        }

        $authors = $book->getAuthor();
        $authors = implode(', ', $authors->toArray());

        $loggedUser = $this->container->get('security.token_storage')->getToken()->getUser();

        /** @var User[] $owners */
        $allOwners = $book->getUser();
        $userOwnBook = $book->hasUser($loggedUser);

        $owners = $allOwners->filter(function ($user) use ($loggedUser) {
            /** @var User $user */
            return $user->getId() !== $loggedUser->getId();
        });

        return $this->render('LibraryBundle:Book:show.html.twig', [
            'book' => $book,
            'authors' => $authors,
            'owners' => $owners,
            'userOwnBook' => $userOwnBook,
        ]);
    }
}
