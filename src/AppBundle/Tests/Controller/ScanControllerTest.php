<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ScanControllerTest extends WebTestCase
{

    public function testCreateTwoNetworkWithSameNetRangeAndName()
    {
        $client = $this->createNetwork('123', 'test');
        $this->assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());

        $client = $this->createNetwork('123', 'test');
        $crawler = $client->getCrawler();
        $this->assertEquals(2, $crawler->filter('li:contains("already in use")')->count());
    }

    private function createNetwork($range, $name) {
        $client = static::createClient();

        $crawler = $client->request('GET', '/scan/new');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Scan')->form(array(
          'appbundle_scan[range]'  => $range,
          'appbundle_scan[store]'  => true,
          'appbundle_scan[name]'  => $name,
        ));

        $client->submit($form);
        return $client;

    }


}
