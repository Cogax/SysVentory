<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Composition
 *select column
 * @ORM\Entity
 * @ORM\Table(name="composition")
 */
class Composition
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
     * @ORM\Column(name="time", type="datetimetz")
     */
    private $time;

    /**
     * @ORM\ManyToMany(targetEntity="NetworkInterface")
     */
    private $networkInterfaces;

    /**
     * @ORM\OneToOne(targetEntity="Machine")
     */
    private $machine;

    /**
     * @ORM\ManyToMany(targetEntity="Cpu")
     */
    private $cpu;

    /**
     * @ORM\ManyToMany(targetEntity="OperatingSystem")
     */
    private $operatingSystems;

    /**
     * @ORM\ManyToMany(targetEntity="Software")
     */
    private $software;

    /**
     * @ORM\ManyToMany(targetEntity="Printer")
     */
    private $printer;


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
     * @return Composition
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
        $this->networkInterfaces = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add networkInterfaces
     *
     * @param \AppBundle\Entity\NetworkInterfaces $networkInterfaces
     * @return Composition
     */
    public function addNetworkInterface(\AppBundle\Entity\NetworkInterfaces $networkInterfaces)
    {
        $this->networkInterfaces[] = $networkInterfaces;

        return $this;
    }

    /**
     * Remove networkInterfaces
     *
     * @param \AppBundle\Entity\NetworkInterfaces $networkInterfaces
     */
    public function removeNetworkInterface(\AppBundle\Entity\NetworkInterfaces $networkInterfaces)
    {
        $this->networkInterfaces->removeElement($networkInterfaces);
    }

    /**
     * Get networkInterfaces
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNetworkInterfaces()
    {
        return $this->networkInterfaces;
    }

    /**
     * Add cpu
     *
     * @param \AppBundle\Entity\Cpu $cpu
     * @return Composition
     */
    public function addCpu(\AppBundle\Entity\Cpu $cpu)
    {
        $this->cpu[] = $cpu;

        return $this;
    }

    /**
     * Remove cpu
     *
     * @param \AppBundle\Entity\Cpu $cpu
     */
    public function removeCpu(\AppBundle\Entity\Cpu $cpu)
    {
        $this->cpu->removeElement($cpu);
    }

    /**
     * Get cpu
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCpu()
    {
        return $this->cpu;
    }

    /**
     * Add operatingSystems
     *
     * @param \AppBundle\Entity\OperatingSystem $operatingSystems
     * @return Composition
     */
    public function addOperatingSystem(\AppBundle\Entity\OperatingSystem $operatingSystems)
    {
        $this->operatingSystems[] = $operatingSystems;

        return $this;
    }

    /**
     * Remove operatingSystems
     *
     * @param \AppBundle\Entity\OperatingSystem $operatingSystems
     */
    public function removeOperatingSystem(\AppBundle\Entity\OperatingSystem $operatingSystems)
    {
        $this->operatingSystems->removeElement($operatingSystems);
    }

    /**
     * Get operatingSystems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOperatingSystems()
    {
        return $this->operatingSystems;
    }

    /**
     * Add software
     *
     * @param \AppBundle\Entity\Software $software
     * @return Composition
     */
    public function addSoftware(\AppBundle\Entity\Software $software)
    {
        $this->software[] = $software;

        return $this;
    }

    /**
     * Remove software
     *
     * @param \AppBundle\Entity\Software $software
     */
    public function removeSoftware(\AppBundle\Entity\Software $software)
    {
        $this->software->removeElement($software);
    }

    /**
     * Get software
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSoftware()
    {
        return $this->software;
    }

    /**
     * Add printer
     *
     * @param \AppBundle\Entity\Printer $printer
     * @return Composition
     */
    public function addPrinter(\AppBundle\Entity\Printer $printer)
    {
        $this->printer[] = $printer;

        return $this;
    }

    /**
     * Remove printer
     *
     * @param \AppBundle\Entity\Printer $printer
     */
    public function removePrinter(\AppBundle\Entity\Printer $printer)
    {
        $this->printer->removeElement($printer);
    }

    /**
     * Get printer
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrinter()
    {
        return $this->printer;
    }

    /**
     * Set machine
     *
     * @param \AppBundle\Entity\Machine $machine
     * @return Composition
     */
    public function setMachine(\AppBundle\Entity\Machine $machine = null)
    {
        $this->machine = $machine;

        return $this;
    }

    /**
     * Get machine
     *
     * @return \AppBundle\Entity\Machine 
     */
    public function getMachine()
    {
        return $this->machine;
    }
}
