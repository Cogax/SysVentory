<?php

namespace AppBundle\Util;


class XsdValidator {
    public function idValid($xml, $xsdFilename) {
        $dom = new \DOMDocument();
        $dom->loadXML($xml);
        return $dom->schemaValidate($xsdFilename);
    }
}