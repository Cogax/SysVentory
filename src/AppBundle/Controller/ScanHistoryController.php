<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\ScanHistory;
use AppBundle\Form\ScanHistoryType;

/**
 * ScanHistory controller.
 *
 */
class ScanHistoryController extends Controller
{

    /**
     * Lists all ScanHistory entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:ScanHistory')->findAll();

        return $this->render('AppBundle:ScanHistory:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a ScanHistory entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:ScanHistory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ScanHistory entity.');
        }


        return $this->render('AppBundle:ScanHistory:show.html.twig', array(
            'entity'      => $entity,
        ));
    }
}
