<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ScanHistory
 *
 * @ORM\Table(name="scanhistory")
 * @ORM\Entity
 */
class ScanHistory
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
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime")
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="netRange", type="string", length=255, nullable=true)
     */
    private $netRange = null;

    /**
     * @ORM\OneToOne(targetEntity="User")
     */
    private $user = null;

    /**
     * @ORM\OneToOne(targetEntity="Network")
     */
    private $network = null;

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
     * Set time
     *
     * @param \DateTime $time
     * @return ScanHistory
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set netRange
     *
     * @param string $netRange
     * @return ScanHistory
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

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return ScanHistory
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set network
     *
     * @param \AppBundle\Entity\Network $network
     * @return ScanHistory
     */
    public function setNetwork(\AppBundle\Entity\Network $network = null)
    {
        $this->network = $network;

        return $this;
    }

    /**
     * Get network
     *
     * @return \AppBundle\Entity\Network 
     */
    public function getNetwork()
    {
        return $this->network;
    }
}
