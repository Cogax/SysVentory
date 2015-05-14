<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Computer
 *
 * @ORM\Table(name="machine")
 * @ORM\Entity
 */
class Machine extends BaseEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="manufracturer", type="string", length=255, nullable=true)
     */
    private $manufracturer = null;

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
     * Set manufraturer
     *
     * @param string $manufraturer
     * @return Machine
     */
    public function setManufraturer($manufracturer)
    {
        $this->manufracturer = $manufracturer;

        return $this;
    }

    /**
     * Get manufraturer
     *
     * @return string 
     */
    public function getManufraturer()
    {
        return $this->manufracturer;
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
     * @param guid $uuid
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
     * @return guid 
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set manufracturer
     *
     * @param string $manufracturer
     * @return Machine
     */
    public function setManufracturer($manufracturer)
    {
        $this->manufracturer = $manufracturer;

        return $this;
    }

    /**
     * Get manufracturer
     *
     * @return string 
     */
    public function getManufracturer()
    {
        return $this->manufracturer;
    }
}
