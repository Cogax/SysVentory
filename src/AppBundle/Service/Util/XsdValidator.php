<?php
namespace AppBundle\Service\Util;


class XsdValidator {
    public function idValid($xml, $xsdFilename) {
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