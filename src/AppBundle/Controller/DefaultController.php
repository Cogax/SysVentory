<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function showAction($id)
    {
        $networkInterface = $this->getDoctrine()
          ->getRepository('AppBundle:NetworkInterface')
          ->find($id);

        if(!$networkInterface) {
            throw $this->createNotFoundException('No NetworkInterface found
            by id: '.$id);
        }

        return $this->render('AppBundle:Default:network_show.html.twig',
          array('interface' => $networkInterface));
    }
}
