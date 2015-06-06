<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 06/06/15
 * Time: 16:11
 */

namespace AppBundle\Service\Util;


class ComponentDiff {

    public function diff($oldComponents, $newComponents) {
        $out = array(
          'normal' => array(),
          'red' => array(),
          'green' => array()
        );
        foreach($oldComponents as $oldComponent) {
            if($newComponents->contains($oldComponent)) {
                // alt und neu
                $out['normal'][] = $oldComponent;
            } else {
                // nur alt
                $out['red'][] = $oldComponent;
            }
        }
        foreach($newComponents as $newComponent) {
            if(!$oldComponents->contains($newComponent)) {
                // nur neu
                $out['green'][] = $newComponent;
            }
        }
        return $out;
    }
}