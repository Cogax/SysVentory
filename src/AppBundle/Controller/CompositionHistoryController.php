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

    public function createFromCompositionId($compositionId) {
        $connection = $this->_em->getConnection();
        $statement = $connection->prepare("INSERT INTO compositionhistory SET composition_id = :composition_id, time = NOW()");
        $statement->bindValue('composition_id', $compositionId);
        $statement->execute();
    }
}
