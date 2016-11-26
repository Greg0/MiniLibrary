<?php

namespace Greg0\LibraryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LibraryBundle:Default:index.html.twig');
    }
}
