<?php

namespace AppBundle\Service;

use AppBundle\Entity\CompositionCache;
use AppBundle\Entity\CompositionHistory;
use AppBundle\Service\Util\HashGenerator;
use AppBundle\Service\Util\Serializer;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CompositionService extends Controller
{
    private $_em;
    private $compositionHistoryService;
    private $compositionCacheService;
    private $hashGenerator;
    private $serializer;

    public function __construct(EntityManager $em, CompositionHistoryService $compositionHistoryService, CompositionCacheService $compositionCacheService, HashGenerator $hashGenerator, Serializer $serializer) {
        $this->_em = $em;
        $this->compositionHistoryService = $compositionHistoryService;
        $this->compositionCacheService = $compositionCacheService;
        $this->hashGenerator = $hashGenerator;
        $this->serializer = $serializer;
    }

    public function store($xmlComposition) {
        // get cached or new composition id
        $composition_id = $this->getCompositionId($xmlComposition);

        // Compositionhistory entry
        $this->compositionHistoryService->createFromCompositionId($composition_id);

    }

    private function getCompositionId($xml) {
        $hash = $this->hashGenerator->getHash($xml);

        if(!$composition_id = $this->compositionCacheService->getCachedCompositionId($hash)) {
            // no cache entry exists - create new composition and compositioncache entity
            $composition = $this->serializer->deserialize($xml, 'AppBundle\Entity\Composition', 'xml');
            $compositionCache = new CompositionCache($hash, $composition);

            $this->_em->persist($composition);
            $this->_em->persist($compositionCache);
            $this->_em->flush();

            $composition_id = $composition->getId();
        }

        return $composition_id;
    }
}
