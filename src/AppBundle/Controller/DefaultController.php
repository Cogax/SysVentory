<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * Home site
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Default:index.html.twig', array(
        ));
    }
}
