<?php
namespace AppBundle\Service\Util;


class HashGenerator {
    public function getHash($input) {
        return md5($input);
    }
}