<?php

namespace Greg0\LibraryBundle\Controller;

use Greg0\LibraryBundle\Entity\Book;
use Greg0\LibraryBundle\Entity\Report;
use Greg0\LibraryBundle\Entity\User;
use Greg0\LibraryBundle\Form\ReportType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BookController extends Controller
{
    public function indexAction()
    {
        $books = $this->getDoctrine()->getRepository('LibraryBundle:Book')->findAllOrderedByTitle();

        return $this->render('LibraryBundle:Book:index.html.twig', [
            'books' => $books,
        ]);
    }

    public function showAction($id = null)
    {
        /** @var Book $book */
        $book = $this->getDoctrine()->getRepository('LibraryBundle:Book')->find($id);

        if (is_null($book))
        {
            throw $this->createNotFoundException('The book does not exist');
        }

        $authors = $book->getAuthor();
        $authors = implode(', ', $authors->toArray());

        $loggedUser = $this->container->get('security.token_storage')->getToken()->getUser();

        /** @var User[] $owners */
        $allOwners   = $book->getUser();
        $userOwnBook = $book->hasUser($loggedUser);

        $owners = $allOwners->filter(function ($user) use ($loggedUser)
        {
            /** @var User $user */
            return $user->getId() !== $loggedUser->getId();
        });

        $report = new Report();
        $reportForm = $this->createForm(ReportType::class, $report);

        return $this->render('LibraryBundle:Book:show.html.twig', [
            'book'        => $book,
            'authors'     => $authors,
            'owners'      => $owners,
            'userOwnBook' => $userOwnBook,
            'reportForm'  => $reportForm->createView(),
        ]);
    }

    public function searchAction(Request $request, $_format)
    {
        $searchKeyword = $request->get('search');
        $searchKeyword = stripslashes($searchKeyword);
        $searchKeyword = strip_tags($searchKeyword);

        $books = $this->getDoctrine()->getRepository('LibraryBundle:Book')->findAllSearch($searchKeyword);

        if ($_format == 'json')
        {
            $returnArray = [];
            foreach ($books as $book)
            {
                $returnArray[] = $book->getTitle();
            }

            return $this->json($returnArray);
        }

        $header = $this->get('translator')->trans('page_header.search_result', ['query' => $searchKeyword], 'LibraryBundle');

        return $this->render('LibraryBundle:Book:index.html.twig', [
            'header' => $header,
            'books' => $books,
        ]);
    }

    public function searchAuthorAction(Request $request)
    {
        $searchKeyword = $request->get('search');
        $searchKeyword = stripslashes($searchKeyword);
        $searchKeyword = strip_tags($searchKeyword);

        $books = $this->getDoctrine()->getRepository('LibraryBundle:Author')->findAllSearch($searchKeyword);


        $returnArray = [];
        foreach ($books as $book)
        {
            $returnArray[] = $book->getFullName();
        }

        return $this->json($returnArray);

    }
}
