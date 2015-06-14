<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $this->assertGreaterThan(0, $crawler->filter('html:contains("SysVentory")')->count(), 'Missing Logo element!');
    }

}
