<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompositionHistory
 *
 * @ORM\Table(name="compositionhitory")
 * @ORM\Entity
 */
class CompositionHistory
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
     * @ORM\Column(name="serialnumber", type="string", length=255)
     */
    private $serialnumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime")
     */
    private $time;

    /**
     * @ORM\ManyToMany(targetEntity="Composition")
     */
    private $composition;


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
     * Set serialnumber
     *
     * @param string $serialnumber
     * @return CompositionHistory
     */
    public function setSerialnumber($serialnumber)
    {
        $this->serialnumber = $serialnumber;

        return $this;
    }

    /**
     * Get serialnumber
     *
     * @return string 
     */
    public function getSerialnumber()
    {
        return $this->serialnumber;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     * @return CompositionHistory
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
     * Constructor
     */
    public function __construct()
    {
        $this->composition = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add composition
     *
     * @param \AppBundle\Entity\Composition $composition
     * @return CompositionHistory
     */
    public function addComposition(\AppBundle\Entity\Composition $composition)
    {
        $this->composition[] = $composition;

        return $this;
    }

    /**
     * Remove composition
     *
     * @param \AppBundle\Entity\Composition $composition
     */
    public function removeComposition(\AppBundle\Entity\Composition $composition)
    {
        $this->composition->removeElement($composition);
    }

    /**
     * Get composition
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComposition()
    {
        return $this->composition;
    }
}
