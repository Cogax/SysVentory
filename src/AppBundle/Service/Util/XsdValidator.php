<?php
namespace AppBundle\Service\Util;


class XsdValidator {
    public function isValid($xml, $xsdFilename) {
        try {
            $dom = new \DOMDocument();
            if(!$dom->loadXML($xml)) {
                return false;
            }

            return $dom->schemaValidate($xsdFilename);
        } catch(\Exception $e) {
            return false;
        }
    }
}