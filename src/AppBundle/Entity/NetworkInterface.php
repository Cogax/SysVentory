<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NetworkInterface
 *
 * @ORM\Table(name="networkinterface")
 * @ORM\Entity
 */
class NetworkInterface extends BaseEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description = null;

    /**
     * @var string
     *
     * @ORM\Column(name="ipv4", type="string")
     */
    private $ipv4;

    /**
     * @var string
     *
     * @ORM\Column(name="ipv4Subnet", type="string", length=255, nullable=true)
     */
    private $ipv4Subnet = null;

    /**
     * @var string
     *
     * @ORM\Column(name="ipv4DefaultGateway", type="string", length=255, nullable=true)
     */
    private $ipv4DefaultGateway = null;

    /**
     * @var string
     *
     * @ORM\Column(name="ipv6", type="string", length=255, nullable=true)
     */
    private $ipv6 = null;

    /**
     * @var string
     *
     * @ORM\Column(name="ipv6Subnet", type="string", length=255, nullable=true)
     */
    private $ipv6Subnet = null;

    /**
     * @var string
     *
     * @ORM\Column(name="ipv6DefaultGateway", type="string", length=255, nullable=true)
     */
    private $ipv6DefaultGateway = null;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dhcp", type="boolean")
     */
    private $dhcp = false;

    /**
     * @var string
     *
     * @ORM\Column(name="mac", type="string", length=255)
     */
    private $mac;

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
     * Set ipv4Subnet
     *
     * @param string $ipv4Subnet
     * @return NetworkInterface
     */
    public function setIpv4Subnet($ipv4Subnet)
    {
        $this->ipv4Subnet = $ipv4Subnet;

        return $this;
    }

    /**
     * Get ipv4Subnet
     *
     * @return string 
     */
    public function getIpv4Subnet()
    {
        return $this->ipv4Subnet;
    }

    /**
     * Set ipv4DefaultGateway
     *
     * @param string $ipv4DefaultGateway
     * @return NetworkInterface
     */
    public function setIpv4DefaultGateway($ipv4DefaultGateway)
    {
        $this->ipv4DefaultGateway = $ipv4DefaultGateway;

        return $this;
    }

    /**
     * Get ipv4DefaultGateway
     *
     * @return string 
     */
    public function getIpv4DefaultGateway()
    {
        return $this->ipv4DefaultGateway;
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
     * Set ipv6Subnet
     *
     * @param string $ipv6Subnet
     * @return NetworkInterface
     */
    public function setIpv6Subnet($ipv6Subnet)
    {
        $this->ipv6Subnet = $ipv6Subnet;

        return $this;
    }

    /**
     * Get ipv6Subnet
     *
     * @return string 
     */
    public function getIpv6Subnet()
    {
        return $this->ipv6Subnet;
    }

    /**
     * Set ipv6DefaultGateway
     *
     * @param string $ipv6DefaultGateway
     * @return NetworkInterface
     */
    public function setIpv6DefaultGateway($ipv6DefaultGateway)
    {
        $this->ipv6DefaultGateway = $ipv6DefaultGateway;

        return $this;
    }

    /**
     * Get ipv6DefaultGateway
     *
     * @return string 
     */
    public function getIpv6DefaultGateway()
    {
        return $this->ipv6DefaultGateway;
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
