<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Composition
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
     * @ORM\ManyToMany(targetEntity="NetworkInterface", cascade={"persist"})
     * @JMS\Type("ArrayCollection<AppBundle\Entity\NetworkInterface>")
     * @JMS\XmlList(entry="network_interface")
     */
    private $networkInterfaces;

    /**
     * @ORM\ManyToOne(targetEntity="Machine", cascade={"persist"})
     */
    private $machine;

    /**
     * @ORM\ManyToMany(targetEntity="Cpu", cascade={"persist"})
     * @JMS\Type("ArrayCollection<AppBundle\Entity\Cpu>")
     * @JMS\XmlList(entry="cpu")
     */
    private $cpus;

    /**
     * @ORM\ManyToOne(targetEntity="OperatingSystem", cascade={"persist"})
     */
    private $operatingSystem;

    /**
     * @ORM\ManyToMany(targetEntity="Software", cascade={"persist"})
     * @JMS\Type("ArrayCollection<AppBundle\Entity\Software>")
     * @JMS\XmlList(entry="software")
     */
    private $softwares;

    /**
     * @ORM\ManyToMany(targetEntity="Printer", cascade={"persist"})
     * @JMS\Type("ArrayCollection<AppBundle\Entity\Printer>")
     * @JMS\XmlList(entry="printer")
     */
    private $printers;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->networkInterfaces = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cpus = new \Doctrine\Common\Collections\ArrayCollection();
        $this->softwares = new \Doctrine\Common\Collections\ArrayCollection();
        $this->printers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add networkInterfaces
     *
     * @param \AppBundle\Entity\NetworkInterface $networkInterfaces
     * @return Composition
     */
    public function addNetworkInterface(\AppBundle\Entity\NetworkInterface $networkInterfaces)
    {
        $this->networkInterfaces[] = $networkInterfaces;

        return $this;
    }

    /**
     * Remove networkInterfaces
     *
     * @param \AppBundle\Entity\NetworkInterface $networkInterfaces
     */
    public function removeNetworkInterface(\AppBundle\Entity\NetworkInterface $networkInterfaces)
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

    /**
     * Add cpus
     *
     * @param \AppBundle\Entity\Cpu $cpus
     * @return Composition
     */
    public function addCpus(\AppBundle\Entity\Cpu $cpus)
    {
        $this->cpus[] = $cpus;

        return $this;
    }

    /**
     * Remove cpus
     *
     * @param \AppBundle\Entity\Cpu $cpus
     */
    public function removeCpus(\AppBundle\Entity\Cpu $cpus)
    {
        $this->cpus->removeElement($cpus);
    }

    /**
     * Get cpus
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCpus()
    {
        return $this->cpus;
    }

    /**
     * Set operatingSystem
     *
     * @param \AppBundle\Entity\OperatingSystem $operatingSystem
     * @return Composition
     */
    public function setOperatingSystem(\AppBundle\Entity\OperatingSystem $operatingSystem = null)
    {
        $this->operatingSystem = $operatingSystem;

        return $this;
    }

    /**
     * Get operatingSystem
     *
     * @return \AppBundle\Entity\OperatingSystem 
     */
    public function getOperatingSystem()
    {
        return $this->operatingSystem;
    }

    /**
     * Add softwares
     *
     * @param \AppBundle\Entity\Software $softwares
     * @return Composition
     */
    public function addSoftware(\AppBundle\Entity\Software $softwares)
    {
        $this->softwares[] = $softwares;

        return $this;
    }

    /**
     * Remove softwares
     *
     * @param \AppBundle\Entity\Software $softwares
     */
    public function removeSoftware(\AppBundle\Entity\Software $softwares)
    {
        $this->softwares->removeElement($softwares);
    }

    /**
     * Get softwares
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSoftwares()
    {
        return $this->softwares;
    }

    /**
     * Add printers
     *
     * @param \AppBundle\Entity\Printer $printers
     * @return Composition
     */
    public function addPrinter(\AppBundle\Entity\Printer $printers)
    {
        $this->printers[] = $printers;

        return $this;
    }

    /**
     * Remove printers
     *
     * @param \AppBundle\Entity\Printer $printers
     */
    public function removePrinter(\AppBundle\Entity\Printer $printers)
    {
        $this->printers->removeElement($printers);
    }

    /**
     * Get printers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrinters()
    {
        return $this->printers;
    }
}
