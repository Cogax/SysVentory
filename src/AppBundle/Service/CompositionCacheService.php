<?php

namespace AppBundle\Service;

use AppBundle\Entity\Composition;
use AppBundle\Entity\CompositionCache;
use Doctrine\ORM\EntityManager;

class CompositionCacheService {
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * Return the compositionId of a composition which is cached. Otherwise it
     * will return false.
     *
     * @param string $hash
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getCachedCompositionId($hash) {
        $connection = $this->entityManager->getConnection();
        $statement = $connection->prepare("SELECT composition_id FROM compositioncache WHERE hash = :hash");
        $statement->bindValue('hash', $hash);
        $statement->execute();
        $results = $statement->fetchAll();
        if(count($results) == 1) {
            return $results[0]['composition_id'];
        }
        return false;
    }
}