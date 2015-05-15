<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Composition;
use AppBundle\Entity\CompositionHistory;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CompositionHistoryController extends Controller
{
    private $_em;

    public function __construct(EntityManager $em) {
        $this->_em = $em;
    }

    public function create(Composition $composition) {
        $compositionHistory = new CompositionHistory();
        $compositionHistory->setComposition($composition);
        $compositionHistory->setTime(new \DateTime());
        $this->_em->persist($compositionHistory);
        $this->_em->flush();
    }
}
