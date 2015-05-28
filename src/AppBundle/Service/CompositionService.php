<?php

namespace AppBundle\Service;

use AppBundle\Entity\CompositionCache;
use AppBundle\Service\Util\HashGenerator;
use AppBundle\Service\Util\Serializer;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CompositionService extends Controller
{
    private $entityManager;
    private $compositionHistoryService;
    private $compositionCacheService;
    private $hashGenerator;
    private $serializer;

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @param \AppBundle\Service\CompositionHistoryService $compositionHistoryService
     * @param \AppBundle\Service\CompositionCacheService $compositionCacheService
     * @param \AppBundle\Service\Util\HashGenerator $hashGenerator
     * @param \AppBundle\Service\Util\Serializer $serializer
     */
    public function __construct(EntityManager $entityManager, CompositionHistoryService $compositionHistoryService, CompositionCacheService $compositionCacheService, HashGenerator $hashGenerator, Serializer $serializer) {
        $this->entityManager = $entityManager;
        $this->compositionHistoryService = $compositionHistoryService;
        $this->compositionCacheService = $compositionCacheService;
        $this->hashGenerator = $hashGenerator;
        $this->serializer = $serializer;
    }

    /**
     *
     *
     * @param $xmlComposition
     * @return bool
     */
    public function storeFromXML($xmlComposition) {
        // get cached or new composition id
        try {
            $composition_id = $this->getCompositionId($xmlComposition);
        } catch(\Exception $e) {
            return false;
        }

        // Compositionhistory entry
        $this->compositionHistoryService->createFromCompositionId($composition_id);

        return true;
    }

    /**
     * Returns the compositionId of a composition delivered by xml. This method
     * takes care of cached compositions and will otherwise create a new
     * composition directly from xml.
     *
     * @param string $xml
     * @return integer
     */
    private function getCompositionId($xml) {
        $hash = $this->hashGenerator->getHash($xml);

        if(!$composition_id = $this->compositionCacheService->getCachedCompositionId($hash)) {
            $composition = $this->createCompositionFromXML($xml);
            $compositionCache = new CompositionCache($hash, $composition);

            $this->entityManager->persist($composition);
            $this->entityManager->persist($compositionCache);
            $this->entityManager->flush();

            $composition_id = $composition->getId();
        }

        return $composition_id;
    }

    /**
     * Creates an composition entity from an XML string input. Interacts with
     * the serializer.
     *
     * @param string $xml
     * @return \AppBundle\Entity\Composition
     */
    private function createCompositionFromXML($xml) {
        return $this->serializer->deserialize($xml, 'AppBundle\Entity\Composition', 'xml');
    }
}
