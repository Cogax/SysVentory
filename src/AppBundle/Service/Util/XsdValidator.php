<?php
namespace AppBundle\Service\Util;


class XsdValidator {
    public function idValid($xml, $xsdFilename) {
        try {
            $dom = new \DOMDocument();
            $dom->loadXML($xml);

            return $dom->schemaValidate($xsdFilename);
        } catch(\Exception $e) {
            return false;
        }
    }
}