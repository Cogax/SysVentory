<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Computer
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Computer
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
     * @ORM\Column(name="manufraturer", type="string", length=255)
     */
    private $manufraturer;

    /**
     * @var string
     *
     * @ORM\Column(name="mdoel", type="string", length=255)
     */
    private $mdoel;

    /**
     * @var integer
     *
     * @ORM\Column(name="memory", type="integer")
     */
    private $memory;

    /**
     * @var string
     *
     * @ORM\Column(name="computerName", type="string", length=255)
     */
    private $computerName;


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
     * Set manufraturer
     *
     * @param string $manufraturer
     * @return Computer
     */
    public function setManufraturer($manufraturer)
    {
        $this->manufraturer = $manufraturer;

        return $this;
    }

    /**
     * Get manufraturer
     *
     * @return string 
     */
    public function getManufraturer()
    {
        return $this->manufraturer;
    }

    /**
     * Set mdoel
     *
     * @param string $mdoel
     * @return Computer
     */
    public function setMdoel($mdoel)
    {
        $this->mdoel = $mdoel;

        return $this;
    }

    /**
     * Get mdoel
     *
     * @return string 
     */
    public function getMdoel()
    {
        return $this->mdoel;
    }

    /**
     * Set memory
     *
     * @param integer $memory
     * @return Computer
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
     * @return Computer
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
}
