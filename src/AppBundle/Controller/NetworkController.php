<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Network;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NetworkController extends Controller
{
    private $_em;

    public function __construct(EntityManager $em) {
        $this->_em = $em;
    }

    public function create($name, $netRange) {
        $network = new Network();
        $network->setName($name);
        $network->setNetRange($netRange);
        $this->_em->persist($network);
        $this->_em->flush();
        return $network;
    }
}
