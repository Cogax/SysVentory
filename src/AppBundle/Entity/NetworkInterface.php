<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NetworkInterface
 *
 * @ORM\Table(name="networkinterface")
 * @ORM\Entity
 */
class NetworkInterface
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
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="ipv4", type="string", length=255)
     */
    private $ipv4;

    /**
     * @var string
     *
     * @ORM\Column(name="ipv6", type="string", length=255)
     */
    private $ipv6;

    /**
     * @var string
     *
     * @ORM\Column(name="subnet", type="string", length=255)
     */
    private $subnet;

    /**
     * @var string
     *
     * @ORM\Column(name="defaultGateway", type="string", length=255)
     */
    private $defaultGateway;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dhcp", type="boolean")
     */
    private $dhcp;

    /**
     * @var string
     *
     * @ORM\Column(name="mac", type="string", length=255)
     */
    private $mac;


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
     * Set description
     *
     * @param string $description
     * @return NetworkInterface
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set ipv4
     *
     * @param string $ipv4
     * @return NetworkInterface
     */
    public function setIpv4($ipv4)
    {
        $this->ipv4 = $ipv4;

        return $this;
    }

    /**
     * Get ipv4
     *
     * @return string 
     */
    public function getIpv4()
    {
        return $this->ipv4;
    }

    /**
     * Set ipv6
     *
     * @param string $ipv6
     * @return NetworkInterface
     */
    public function setIpv6($ipv6)
    {
        $this->ipv6 = $ipv6;

        return $this;
    }

    /**
     * Get ipv6
     *
     * @return string 
     */
    public function getIpv6()
    {
        return $this->ipv6;
    }

    /**
     * Set subnet
     *
     * @param string $subnet
     * @return NetworkInterface
     */
    public function setSubnet($subnet)
    {
        $this->subnet = $subnet;

        return $this;
    }

    /**
     * Get subnet
     *
     * @return string 
     */
    public function getSubnet()
    {
        return $this->subnet;
    }

    /**
     * Set defaultGateway
     *
     * @param string $defaultGateway
     * @return NetworkInterface
     */
    public function setDefaultGateway($defaultGateway)
    {
        $this->defaultGateway = $defaultGateway;

        return $this;
    }

    /**
     * Get defaultGateway
     *
     * @return string 
     */
    public function getDefaultGateway()
    {
        return $this->defaultGateway;
    }

    /**
     * Set dhcp
     *
     * @param boolean $dhcp
     * @return NetworkInterface
     */
    public function setDhcp($dhcp)
    {
        $this->dhcp = $dhcp;

        return $this;
    }

    /**
     * Get dhcp
     *
     * @return boolean 
     */
    public function getDhcp()
    {
        return $this->dhcp;
    }

    /**
     * Set mac
     *
     * @param string $mac
     * @return NetworkInterface
     */
    public function setMac($mac)
    {
        $this->mac = $mac;

        return $this;
    }

    /**
     * Get mac
     *
     * @return string 
     */
    public function getMac()
    {
        return $this->mac;
    }
}
