<?php
namespace AppBundle\Service\Util;

class Collector {
    const HOST = "172.17.82.42";
    const USERNAME = "administrator";
    const PASSWORD = "Password1";
    const DOMAIN = "zbw.local";
    /**
     * @param string $netRange
     */
    public function scan($netRange) {
        $cmd = "/srv/script/discovery.sh ".$netRange." ".self::USERNAME." ".self::PASSWORD." ".self::HOST." '".self::DOMAIN."'";
        $out = array();
        exec($cmd, $out);
        print_r($out);
    }
}