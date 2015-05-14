<?php

namespace AppBundle\Util;


class HashGenerator {
    public function getHash($input) {
        return md5($input);
    }
}