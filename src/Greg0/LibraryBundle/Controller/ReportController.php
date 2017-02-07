<?php

namespace Greg0\LibraryBundle\Controller;

use Greg0\LibraryBundle\Entity\Book;
use Greg0\LibraryBundle\Entity\Report;
use Greg0\LibraryBundle\Form\ReportType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReportController extends Controller
{
    public function reportBookAction($bookId, Request $request)
    {
        /** @var Book $book */
        $book = $this->getDoctrine()->getRepository('LibraryBundle:Book')->find($bookId);

        if (is_null($book))
        {
            throw $this->createNotFoundException('The book does not exist');
        }

        $loggedUser = $this->container->get('security.token_storage')->getToken()->getUser();

        if ($request->isMethod('POST'))
        {
            $report     = new Report();
            $reportForm = $this->createForm(ReportType::class, $report);
            $reportForm->handleRequest($request);

            if ($reportForm->isSubmitted() && $reportForm->isValid())
            {
                $report->setBook($book);
                $report->setAuthor($loggedUser);
                $report->setVerified(false);
                $em = $this->getDoctrine()->getManager();
                $em->persist($report);
                $em->flush();

                $this->addFlash('success', $this->get('translator')->trans('report.sent', [], 'LibraryBundle'));

                return $this->redirectToRoute('book_show', ['id' => $bookId]);
            }
        }

        return $this->redirectToRoute('book_show', ['id' => $bookId]);
    }

    public function listAction()
    {
        $reports = $this->getDoctrine()->getRepository('LibraryBundle:Report')->findAll();

        return $this->render('@Library/Report/list.html.twig', [
            'reports' => $reports,
        ]);
    }

    public function showAction($reportId)
    {
        /** @var Report $report */
        $report = $this->getDoctrine()->getRepository('LibraryBundle:Report')->find($reportId);

        if (is_null($report))
        {
            throw $this->createNotFoundException('The report does not exist');
        }

        return $this->render('@Library/Report/show.html.twig', [
            'report' => $report,
        ]);
    }

    public function verifyAction($reportId)
    {
        /** @var Report $report */
        $report = $this->getDoctrine()->getRepository('LibraryBundle:Report')->find($reportId);

        if (is_null($report))
        {
            throw $this->createNotFoundException('The report does not exist');
        }
        $report->setVerified(!$report->isVerified());
        $em = $this->getDoctrine()->getManager();
        $em->persist($report);
        $em->flush();

        $this->addFlash('success', $this->get('translator')->trans('report.verified', [], 'LibraryBundle'));

        return $this->redirectToRoute('report_show', ['reportId' => $reportId]);
    }
}
