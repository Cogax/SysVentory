<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OperatingSystem
 *
 * @ORM\Table(name="operatingsystem")
 * @ORM\Entity
 */
class OperatingSystem extends BaseEntity
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
     * @ORM\Column(name="version", type="string", length=255)
     */
    private $version;

    /**
     * @var string
     *
     * @ORM\Column(name="servicePack", type="string", length=255, nullable=true)
     */
    private $servicePack = null;

    /**
     * @var string
     *
     * @ORM\Column(name="architecture", type="string", length=255)
     */
    private $architecture;

    /**
     * Set name
     *
     * @param string $name
     * @return OperatingSystem
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
     * Set version
     *
     * @param string $version
     * @return OperatingSystem
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

    /**
     * Set servicePack
     *
     * @param string $servicePack
     * @return OperatingSystem
     */
    public function setServicePack($servicePack)
    {
        $this->servicePack = $servicePack;

        return $this;
    }

    /**
     * Get servicePack
     *
     * @return string 
     */
    public function getServicePack()
    {
        return $this->servicePack;
    }

    /**
     * Set architecture
     *
     * @param string $architecture
     * @return OperatingSystem
     */
    public function setArchitecture($architecture)
    {
        $this->architecture = $architecture;

        return $this;
    }

    /**
     * Get architecture
     *
     * @return string 
     */
    public function getArchitecture()
    {
        return $this->architecture;
    }
}
