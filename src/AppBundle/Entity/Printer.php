<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Printer
 *
 * @ORM\Table(name="printer")
 * @ORM\Entity
 */
class Printer extends BaseEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="driver", type="string", length=255)
     */
    private $driver;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255, nullable=true)
     */
    private $version = null;

    /**
     * Set name
     *
     * @param string $name
     * @return Printer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set driver
     *
     * @param string $driver
     * @return Printer
     */
    public function setDriver($driver)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get driver
     *
     * @return string 
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Set version
     *
     * @param string $version
     * @return Printer
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string 
     */
    public function getVersion()
    {
        return $this->version;
    }
}
