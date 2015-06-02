<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Composition;

/**
 * Composition controller.
 *
 */
class CompositionController extends Controller
{

    /**
     * Lists all Composition entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $compositions = $em->getRepository('AppBundle:Composition')->findAll();

        $compositionHistories = array();
        foreach($compositions as $composition) {
            $compositionHistory = $em->getRepository('AppBundle:CompositionHistory')->findOneByComposition($composition, array('time' => 'DESC'));
            $compositionHistories[$composition->getId()] = $compositionHistory;
        }


        return $this->render('AppBundle:Composition:index.html.twig', array(
            'compositions' => $compositions,
            'compositionHistories' => $compositionHistories,
        ));
    }

    /**
     * Finds and displays a Composition entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Composition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Composition entity.');
        }

        return $this->render('AppBundle:Composition:show.html.twig', array(
            'composition'      => $entity,
        ));
    }
}
