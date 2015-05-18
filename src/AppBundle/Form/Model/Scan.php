<?php

namespace AppBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Scan {
    /**
     * @var string
     * @Assert\NotBlank()
     */
    protected $range;

    /**
     * @var boolean
     * @Assert\NotNull()
     */
    protected $store;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @return string
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * @param string $range
     */
    public function setRange($range)
    {
        $this->range = $range;
    }

    /**
     * @return boolean
     */
    public function isStore()
    {
        return $this->store;
    }

    /**
     * @param boolean $store
     */
    public function setStore($store)
    {
        $this->store = $store;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}