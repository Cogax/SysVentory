<?php

namespace AppBundle\Controller;

use AppBundle\Util\Serializer;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CompositionController extends Controller
{
    private $_em;
    private $compositionHistoryController;
    private $hashGenerator;
    private $serializer;

    public function __construct(EntityManager $em, CompositionHistoryController $compositionHistoryController, $hashGenerator, Serializer $serializer) {
        $this->_em = $em;
        $this->compositionHistoryController = $compositionHistoryController;
        $this->hashGenerator = $hashGenerator;
        $this->serializer = $serializer;
    }

    public function store($xmlComposition) {
        $composition = $this->loadFromXML($xmlComposition);

        // Compositionhistory entry
        $this->compositionHistoryController->create($composition);
    }

    private function loadFromXML($xml) {
        $hash = $this->hashGenerator->getHash($xml);
        $composition = $this->_em->getRepository('AppBundle:Composition')->findOneByHash($hash);
        if(!$composition) {
            // create composition entities
            $composition = $this->serializer->deserialize($xml, 'AppBundle\Entity\Composition', 'xml');
            $composition->setHash($hash);
            $this->_em->persist($composition);
            $this->_em->flush();
        }
        return $composition;
    }
}
