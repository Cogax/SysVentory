<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Network;
use AppBundle\Form\Model\Scan;
use AppBundle\Form\Type\ScanType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ScanController extends Controller {

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
                    $network = new Network();
                    $network->setNetRange($scan->getRange());
                    $network->setName($scan->getName());

                    $validator = $this->get("validator");
                    $errors = $validator->validate($network);
                    if(count($errors) > 0) {
                        return $this->render('AppBundle:Scan:new.html.twig', array(
                          'entity' => $scan,
                          'errors' => $errors,
                          'form'   => $form->createView(),
                        ));
                        //die(print_r($errors));
                    }

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($network);
                    $em->flush();

                    return new Response("stored", Response::HTTP_CREATED);

                    // todo scan will run on next automatically scan
                } else {
                    $this->get("app.collector")->scan($scan);
                }
            }
        }

        return $this->render('AppBundle:Scan:new.html.twig', array(
          'entity' => $scan,
          'form'   => $form->createView(),
        ));
    }
}