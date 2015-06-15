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
     */
    public function indexAction()
    {
        $distinctCompositions = $this->get("app.composition_controller")->getActualMachineCompositions();

        $em = $this->getDoctrine()->getManager();
        $compositionHistories = array();
        foreach($distinctCompositions as $composition) {
            $compositionHistory = $em->getRepository('AppBundle:CompositionHistory')->findOneByComposition($composition, array('time' => 'DESC'));
            $compositionHistories[$composition->getId()] = $compositionHistory;
        }

        return $this->render('AppBundle:Composition:index.html.twig', array(
            'compositions' => $distinctCompositions,
            'compositionHistories' => $compositionHistories,
        ));
    }

    /**
     * Finds and displays a Composition entity.
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        // load composition entity
        $composition = $em->getRepository('AppBundle:Composition')->find($id);
        if (!$composition) {
            throw $this->createNotFoundException('Unable to find Composition entity.');
        }

        // load compositions of the machine uuid for comparing
        $historyVersions = array();
        $historyCompositions = $em->getRepository('AppBundle:Composition')->findAll();
        foreach($historyCompositions as $historyComposition) {
            if($historyComposition->getMachine()->getUuid() != $composition->getMachine()->getUuid()) {
                continue;
            }

            $compositionHistory = $em->getRepository('AppBundle:CompositionHistory')->findOneByComposition($historyComposition, array('time' => 'DESC'));
            $historyVersions[$compositionHistory->getTime()->getTimestamp()] = array(
                'id' => $historyComposition->getId(),
                'time' => $compositionHistory->getTime(),
            );
        }
        krsort($historyVersions);

        return $this->render('AppBundle:Composition:show.html.twig', array(
            'composition'      => $composition,
            'historyVersions'      => $historyVersions,
        ));
    }

    /**
     * Finds and displays a Composition entity.
     */
    public function showOldAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        // load composition entity
        $composition = $em->getRepository('AppBundle:Composition')->find($id);

        return $this->render('AppBundle:Composition:showOld.html.twig', array(
          'composition'      => $composition,
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
