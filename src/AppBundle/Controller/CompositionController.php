<?php

namespace AppBundle\Controller;

use AppBundle\Service\CompositionCacheService;
use AppBundle\Util\Serializer;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CompositionController extends Controller
{
    private $_em;
    private $compositionHistoryController;
    private $compositionCache;
    private $hashGenerator;
    private $serializer;

    public function __construct(EntityManager $em, CompositionHistoryController $compositionHistoryController, CompositionCacheService $compositionCacheService, $hashGenerator, Serializer $serializer) {
        $this->_em = $em;
        $this->compositionHistoryController = $compositionHistoryController;
        $this->compositionCacheService = $compositionCacheService;
        $this->hashGenerator = $hashGenerator;
        $this->serializer = $serializer;
    }

    public function store($xmlComposition) {
        // get cached or new composition id
        $composition_id = $this->getCompositionId($xmlComposition);

        // Compositionhistory entry
        $this->compositionHistoryController->createFromCompositionId($composition_id);

    }

    private function getCompositionId($xml) {
        $hash = $this->hashGenerator->getHash($xml);

        if(!$composition_id = $this->compositionCacheService->getCachedCompositionId($hash)) {
            // no cache entry exists - create new composition and compositioncache entity
            $composition = $this->serializer->deserialize($xml, 'AppBundle\Entity\Composition', 'xml');
            $this->_em->persist($composition);
            $this->_em->flush();

            $this->compositionCacheService->create($composition, $hash);
            $composition_id = $composition->getId();
        }

        return $composition_id;
    }
}
