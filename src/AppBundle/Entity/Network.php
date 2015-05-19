<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Network
 *
 * @ORM\Table(name="network")
 * @ORM\Entity
 * @UniqueEntity(fields={"name"}, message="Sorry, this name is already in use.")
 * @UniqueEntity(fields={"netRange"}, message="Sorry, this range is already in use.")
 */
class Network
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="netRange", type="string", length=255, unique=true)
     */
    private $netRange;

    /**
     * @param string $name
     * @param string $netRange
     */
    public function __construct($name, $netRange) {
        $this->name = $name;
        $this->netRange = $netRange;
    }

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
     * Set name
     *
     * @param string $name
     * @return Network
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
     * Set netRange
     *
     * @param string $netRange
     * @return Network
     */
    public function setNetRange($netRange)
    {
        $this->netRange = $netRange;

        return $this;
    }

    /**
     * Get netRange
     *
     * @return string 
     */
    public function getNetRange()
    {
        return $this->netRange;
    }
}
