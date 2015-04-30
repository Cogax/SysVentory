<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompositionCache
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CompositionCache
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
     * @ORM\Column(name="hash", type="string", length=32)
     */
    private $hash;


    /**
     * @ORM\OneToOne(targetEntity="Composition")
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
     * Set hash
     *
     * @param string $hash
     * @return CompositionCache
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return string 
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set composition
     *
     * @param \AppBundle\Entity\Composition $composition
     * @return CompositionCache
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
