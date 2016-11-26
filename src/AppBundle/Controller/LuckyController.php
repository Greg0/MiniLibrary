<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LuckyController extends Controller
{
    public function numberAction()
    {
        return $this->render('AppBundle:Lucky:number.html.twig', array(
            // ...
        ));
    }

}
