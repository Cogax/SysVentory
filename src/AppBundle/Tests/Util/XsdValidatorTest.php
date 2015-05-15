<?php

namespace AppBundle\Tests\Util;

use AppBundle\Util\XsdValidator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class XsdValidatorTest extends KernelTestCase {
    /**
     * @var XsdValidator
     */
    private $validator;

    private $xsd;

    public function setUp() {
        self::bootKernel();
        $this->validator = static::$kernel->getContainer()->get("app.xsd_validator");
        $this->xsd = static::$kernel->locateResource('@AppBundle/Resources/schema/composition.xsd');
    }

    public function testInvalidMachine() {
        $xml = file_get_contents(getcwd().'/src/AppBundle/Tests/Resources/XsdValidatorTestData_InvalidMachine.xml');
        $this->assertEquals(false, $this->validator->idValid($xml, $this->xsd));
    }

    public function testInvalidOperatingSystem() {
        $xml = file_get_contents(getcwd().'/src/AppBundle/Tests/Resources/XsdValidatorTestData_InvalidOperatingSystem.xml');
        $this->assertEquals(false, $this->validator->idValid($xml, $this->xsd));
    }

    public function testInvalidSoftware() {
        $xml = file_get_contents(getcwd().'/src/AppBundle/Tests/Resources/XsdValidatorTestData_InvalidSoftware.xml');
        $this->assertEquals(false, $this->validator->idValid($xml, $this->xsd));
    }

    public function testInvalidCpu() {
        $xml = file_get_contents(getcwd().'/src/AppBundle/Tests/Resources/XsdValidatorTestData_InvalidCpu.xml');
        $this->assertEquals(false, $this->validator->idValid($xml, $this->xsd));
    }

    public function testInvalidNetworkInterface() {
        $xml = file_get_contents(getcwd().'/src/AppBundle/Tests/Resources/XsdValidatorTestData_InvalidNetworkInterface.xml');
        $this->assertEquals(false, $this->validator->idValid($xml, $this->xsd));
    }

    public function testInvalidPrinter() {
        $xml = file_get_contents(getcwd().'/src/AppBundle/Tests/Resources/XsdValidatorTestData_InvalidPrinter.xml');
        $this->assertEquals(false, $this->validator->idValid($xml, $this->xsd));
    }

}

