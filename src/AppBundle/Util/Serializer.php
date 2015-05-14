<?php

namespace AppBundle\Util;


class Serializer {
    private $serializer;

    public function __construct(\JMS\Serializer\Serializer $serializer) {
        $this->serializer = $serializer;
    }

    public function deserialize($data, $type, $format) {
        return $this->serializer->deserialize($data, $type, $format);
    }
}