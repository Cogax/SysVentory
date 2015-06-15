<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\ScanHistory;
use AppBundle\Form\ScanHistoryType;

/**
 * ScanHistory controller.
 */
class ScanHistoryController extends Controller
{

    /**
     * Lists all ScanHistory entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:ScanHistory')->findBy(array(), array('time' => 'DESC'));

        return $this->render('AppBundle:ScanHistory:index.html.twig', array(
            'entities' => $entities,
        ));
    }
}
