<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CompositionHistoryService extends Controller
{
    private $entityManager;

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * Creates a compositionhistory without all the doctrine stuff for optimal
     * performance.
     *
     * @param string $compositionId
     * @throws \Doctrine\DBAL\DBALException
     */
    public function createFromCompositionId($compositionId) {
        $connection = $this->entityManager->getConnection();
        $statement = $connection->prepare("INSERT INTO compositionhistory SET composition_id = :composition_id, time = NOW()");
        $statement->bindValue('composition_id', $compositionId);
        $statement->execute();
    }
}