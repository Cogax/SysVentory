<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Computer
 *
 * @ORM\Table(name="machine")
 * @ORM\Entity
 */
class Machine
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="manufacturer", type="string", length=255, nullable=true)
     */
    private $manufacturer = null;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=255, nullable=true)
     */
    private $model = null;

    /**
     * @var integer
     *
     * @ORM\Column(name="memory", type="integer", nullable=true)
     */
    private $memory = null;

    /**
     * @var string
     *
     * @ORM\Column(name="computerName", type="string", length=255, nullable=true)
     */
    private $computerName = null;

    /**
     * @var string
     *
     * @ORM\Column(name="serialNumber", type="string", length=255)
     */
    private $serialNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string")
     */
    private $uuid;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set manufacturer
     *
     * @param string $manufacturer
     * @return Machine
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return string 
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Set model
     *
     * @param string $model
     * @return Machine
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string 
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set memory
     *
     * @param integer $memory
     * @return Machine
     */
    public function setMemory($memory)
    {
        $this->memory = $memory;

        return $this;
    }

    /**
     * Get memory
     *
     * @return integer 
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     * Set computerName
     *
     * @param string $computerName
     * @return Machine
     */
    public function setComputerName($computerName)
    {
        $this->computerName = $computerName;

        return $this;
    }

    /**
     * Get computerName
     *
     * @return string 
     */
    public function getComputerName()
    {
        return $this->computerName;
    }

    /**
     * Set serialNumber
     *
     * @param string $serialNumber
     * @return Machine
     */
    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    /**
     * Get serialNumber
     *
     * @return string 
     */
    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    /**
     * Set uuid
     *
     * @param string $uuid
     * @return Machine
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get uuid
     *
     * @return string 
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param \AppBundle\Entity\Machine $machine
     * @return bool
     */
    public function equalByProperties(Machine $machine) {
        return (
            $this->getComputerName() == $machine->getComputerName() &&
            $this->getManufacturer() == $machine->getManufacturer() &&
            $this->getMemory() == $machine->getMemory() &&
            $this->getModel() == $machine->getModel() &&
            $this->getSerialNumber() == $machine->getSerialNumber() &&
            $this->getUuid() == $machine->getUuid()
        );
    }
}
