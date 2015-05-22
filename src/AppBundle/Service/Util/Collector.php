<?php
namespace AppBundle\Service\Util;

class Collector {
    const HOST = "172.17.82.42";
    const USERNAME = "administrator";
    const PASSWORD = "Password1";

    /**
     * @param string $netRange
     */
    public function scan($netRange) {
        $cmd = printf('/srv/script/discovery.sh %s %s %s %s', $netRange, self::USERNAME, self::PASSWORD, self::HOST);
        $return = shell_exec($cmd);
        die($return);
    }
}