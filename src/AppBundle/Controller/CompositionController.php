<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

        // add history entries
        $compositionHistories = array();
        foreach($compositions as $composition) {
            $compositionHistory = $em->getRepository('AppBundle:CompositionHistory')->findOneByComposition($composition, array('time' => 'DESC'));
            $compositionHistories[$composition->getId()] = $compositionHistory;
        }

        // distinct compositions on machine uuid by date
        $distinctCompositions = array();
        foreach($compositions as $composition) {
            if(!array_key_exists($composition->getMachine()->getUuid(), $distinctCompositions) ||
                $compositionHistories[$composition->getId()]->getTime() > $compositionHistories[$distinctCompositions[$composition->getMachine()->getUuid()]->getId()]->getTime()) {
                $distinctCompositions[$composition->getMachine()->getUuid()] = $composition;
            }
        }

        return $this->render('AppBundle:Composition:index.html.twig', array(
            'compositions' => $distinctCompositions,
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

    /**
     * Compares two Compositions
     */
    public function compareAction($oldId, $newId) {
        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository('AppBundle:Composition');
        $oldComposition = $repo->find($oldId);
        $newComposition = $repo->find($newId);

        if (!$oldComposition) {
            throw $this->createNotFoundException('Unable to find old Composition entity.');
        }
        if (!$newComposition) {
            throw $this->createNotFoundException('Unable to find new Composition entity.');
        }

        $oldComputer = false;
        $newComputer = false;
        if(!$oldComposition->getMachine()->equalByProperties($newComposition->getMachine())) {
            $newComputer = $newComposition->getMachine();
            $oldComputer = $oldComposition->getMachine();
        }

        $oldOS = false;
        $newOS = false;
        if(!$oldComposition->getOperatingSystem()->equalByProperties($newComposition->getOperatingSystem())) {
            $newOS = $newComposition->getOperatingSystem();
            $oldOS = $oldComposition->getOperatingSystem();
        }

        $diffService = $this->get('app.component_diff');
        $networkInterfaces = $diffService->diff($oldComposition->getNetworkInterfaces(), $newComposition->getNetworkInterfaces());
        $cpus = $diffService->diff($oldComposition->getCpus(), $newComposition->getCpus());
        $printers = $diffService->diff($oldComposition->getPrinters(), $newComposition->getPrinters());
        $softwares = $diffService->diff($oldComposition->getSoftwares(), $newComposition->getSoftwares());


        return $this->render('AppBundle:Composition:compare.html.twig', array(
          'oldComposition' => $oldComposition,
          'newComposition' => $newComposition,
          'oldComputer' => $oldComputer,
          'newComputer' => $newComputer,
          'oldOS' => $oldOS,
          'newOS' => $newOS,
          'networkInterfaces' => $networkInterfaces,
          'cpus' => $cpus,
          'printers' => $printers,
          'softwares' => $softwares,
        ));
    }
}
