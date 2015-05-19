<?php

namespace AppBundle\Service;

use AppBundle\Entity\Composition;
use AppBundle\Entity\CompositionCache;
use Doctrine\ORM\EntityManager;

class CompositionCacheService {
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $_em;

    /**
     * @param \Doctrine\ORM\EntityManager $em
     */
    public function __construct(EntityManager $em) {
        $this->_em = $em;
    }

    /**
     * @param \AppBundle\Entity\Composition $composition
     * @param string $hash
     */
    public function create(Composition $composition, $hash) {
        $compositionCache = new CompositionCache();
        $compositionCache->setComposition($composition);
        $compositionCache->setHash($hash);
        $this->_em->persist($compositionCache);
        $this->_em->flush();
    }

    /**
     * @param string $hash
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getCachedCompositionId($hash) {
        $connection = $this->_em->getConnection();
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