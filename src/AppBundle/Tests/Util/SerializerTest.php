<?php

namespace AppBundle\Tests\Util;


use AppBundle\Entity\Composition;
use AppBundle\Util\Serializer;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SerializerTest extends KernelTestCase {
    /**
     * @var Composition
     */
    private $composition;

    public function setUp() {
        self::bootKernel();
        $serializer = static::$kernel->getContainer()->get("app.serializer");
        $xml = file_get_contents(getcwd().'/web/target.xml');
        $this->composition = $serializer->deserialize($xml, 'AppBundle\Entity\Composition', 'xml');
    }

    public function testMachine() {
        $machine = $this->composition->getMachine();
        $this->assertEquals('Bochs', $machine->getManufracturer());
        $this->assertEquals('Bochs', $machine->getModel());
        $this->assertEquals('', $machine->getSerialNumber());
        $this->assertEquals(2147069952, $machine->getMemory());
        $this->assertEquals('CLIENT01-01', $machine->getComputerName());
        $this->assertEquals('79B60242-1F48-F7E9-8169-FB15DFB0B212', $machine->getUuid());
    }

    public function testOperatingSystem() {
        $os = $this->composition->getOperatingSystem();
        $this->assertEquals('Microsoft Windows 7 Professional', $os->getName());
        $this->assertEquals('php 6.1.7601', $os->getVersion());
        $this->assertEquals('1', $os->getServicePack());
        $this->assertEquals('64-Bit', $os->getArchitecture());
    }

    public function testSoftwares() {
        $this->assertEquals(2, $this->composition->getSoftwares()->count());

        $software = $this->composition->getSoftwares()->get(1);
        $this->assertEquals('Microsoft .NET Framework 4 Client Profile', $software->getName());
        $this->assertEquals('4.0.30319', $software->getVersion());
    }

    public function testCpus() {
        $this->assertEquals(1, $this->composition->getCpus()->count());

        $cpu = $this->composition->getCpus()->get(0);
        $this->assertEquals('Intel Xeon E312xx (Sandy Bridge)', $cpu->getName());
        $this->assertEquals('Intel64 Family 6 Model 42 Stepping 1', $cpu->getFamily());
        $this->assertEquals(3301, $cpu->getClock());
        $this->assertEquals(3, $cpu->getCores());
    }

    public function testNetworkInterfaces() {
        $this->assertEquals(1, $this->composition->getNetworkInterfaces()->count());

        $ni = $this->composition->getNetworkInterfaces()->get(0);
        $this->assertEquals('Intel(R) PRO/1000 MT-Netzwerkverbindung', $ni->getDescription());
        $this->assertEquals('172.17.82.101', $ni->getIpv4());
        $this->assertEquals('255.255.255.0', $ni->getIpv4Subnet());
        $this->assertEquals('172.17.82.1', $ni->getIpv4DefaultGateway());
        $this->assertEquals('2a02:16a0:ff02:82:44d0:53b2:4010:b3dc', $ni->getIpv6());
        $this->assertEquals('64', $ni->getIpv6Subnet());
        $this->assertEquals('fe80::5054:ff:fe6d:bd37', $ni->getIpv6DefaultGateway());
        $this->assertEquals(false, $ni->getDhcp());
        $this->assertEquals('52:54:00:9C:30:73', $ni->getMac());
    }

    public function testPrinters() {
        $this->assertEquals(2, $this->composition->getPrinters()->count());

        $printer = $this->composition->getPrinters()->get(1);
        $this->assertEquals('Microsoft XPS Document Writer', $printer->getName());
        $this->assertEquals('Microsoft XPS Document Writer', $printer->getDriver());
        $this->assertEquals('', $printer->getVersion());
    }

}
