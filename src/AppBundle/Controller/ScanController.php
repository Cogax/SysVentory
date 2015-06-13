<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Network;
use AppBundle\Entity\ScanHistory;
use AppBundle\Form\Model\Scan;
use AppBundle\Form\Type\ScanType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ScanController extends Controller {

    /**
     * Make a new scan.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction() {
        $scan = new Scan();
        $form = $this->createForm(new ScanType(), $scan);

        $request = $this->container->get('request');

        if('POST' === $request->getMethod()) {
            $form->handleRequest($request);

            if($form->isValid()) {

                // Create a network entity if it will be stored, elsewhere run
                // scan now.
                if($scan->isStore()) {
                    $network = new Network($scan->getName(), $scan->getRange());

                    $validator = $this->get("validator");
                    $errors = $validator->validate($network);
                    if(count($errors) > 0) {
                        return $this->render('AppBundle:Scan:new.html.twig', array(
                          'entity' => $scan,
                          'errors' => $errors,
                          'form'   => $form->createView(),
                        ));
                    }

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($network);
                    $em->flush();
                }
                if($this->get('kernel')->getEnvironment() != 'test') {
                    try {
                        $this->get("app.collector")->scan($scan->getRange());

                        $history = new ScanHistory();
                        if(isset($network)) {
                            $history->setNetwork($network);
                        } else {
                            $history->setNetRange($scan->getRange());
                        }
                        $history->setTime(new \DateTime());
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($history);
                        $em->flush();
                    } catch(\Exception $e) {
                        //echo $e->getMessage();
                    }
                }
                return $this->render('AppBundle:Scan:done.html.twig', array());
            }
        }

        return $this->render('AppBundle:Scan:new.html.twig', array(
          'entity' => $scan,
          'form'   => $form->createView(),
        ));
    }

    /**
     * Scan all stored networks.
     */
    public function scanStoredNetworksAction() {
        $em = $this->getDoctrine()->getManager();
        $networks = $em->getRepository("AppBundle:Network")->findAll();
        foreach($networks as $network) {
            try {
                $this->get("app.collector")->scan($network->getNetRange());

                $history = new ScanHistory();
                $history->setNetwork($network);
                $history->setTime(new \DateTime());
                $em->persist($history);
                $em->flush();
            } catch(\Exception $e) {
                //echo $e->getMessage();
            }
        }

        return $this->render('AppBundle:Scan:done.html.twig', array());
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function scanNetworkAction($id) {
        $em = $this->getDoctrine()->getManager();
        $network = $em->getRepository("AppBundle:Network")->findById($id);

        $this->get("app.collector")->scan($network->getNetRange());

        $history = new ScanHistory();
        $history->setNetwork($network);
        $history->setTime(new \DateTime());
        $em->persist($history);
        $em->flush();

        return $this->render('AppBundle:Scan:done.html.twig', array());
    }
}