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
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime")
     */
    private $time;

    /**
     * @ORM\ManyToOne(targetEntity="Composition")
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
     * Set composition
     *
     * @param \AppBundle\Entity\Composition $composition
     * @return CompositionHistory
     */
    public function setComposition(\AppBundle\Entity\Composition $composition = null)
    {
        $this->composition = $composition;

        return $this;
    }

    /**
     * Get composition
     *
     * @return \AppBundle\Entity\Composition 
     */
    public function getComposition()
    {
        return $this->composition;
    }
}
