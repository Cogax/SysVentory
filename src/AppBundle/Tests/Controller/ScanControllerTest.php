<?php

namespace AppBundle\Tests\Controller;

use AppBundle\DataFixtures\Tests\LoadUserData;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ScanControllerTest extends WebTestCase
{
    public function setup() {
        $client = static::createClient();
        $container = $client->getContainer();
        $doctrine = $container->get('doctrine');
        $entityManager = $doctrine->getManager();

        $fixture = new LoadUserData();
        $fixture->load($entityManager);
    }

    public function testCreateTwoNetworkWithSameNetRangeAndName()
    {
        $this->login('testadmin', 'testadmin');

        $client = $this->createNetwork('123', 'test');
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        $client = $this->createNetwork('123', 'test');
        $crawler = $client->getCrawler();
        $this->assertEquals(2, $crawler->filter('li:contains("already in use")')->count());
    }

    private function login($username, $password) {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('_submit')->form(array(
          '_username'  => $username,
          '_password'  => $password,
        ));
        $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect());

        $crawler = $client->followRedirect();
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
