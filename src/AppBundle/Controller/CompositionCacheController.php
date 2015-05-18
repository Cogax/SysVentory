<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CompositionCache;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CompositionCacheController extends Controller
{
    private $_em;

    public function __construct(EntityManager $em) {
        $this->_em = $em;
    }

    public function create($composition, $hash) {
        $compositionCache = new CompositionCache();
        $compositionCache->setComposition($composition);
        $compositionCache->setHash($hash);
        $this->_em->persist($compositionCache);
        $this->_em->flush();
    }

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
