<?php

namespace AppBundle\Tests\Controller;

use AppBundle\DataFixtures\LoadUserData;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ScanControllerTest extends WebTestCase
{
    private $client;

    public function setup() {
        $this->client = static::createClient();
        $container = $this->client->getContainer();
        $doctrine = $container->get('doctrine');
        $entityManager = $doctrine->getManager();

        $fixture = new LoadUserData();
        $fixture->load($entityManager);

        $this->doLogin('inventor', 'inventor');
    }

    public function testCreateTwoNetworkWithSameNetRangeAndName()
    {
        $this->createNetwork('123', 'test');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $this->createNetwork('123', 'test');
        $crawler = $this->client->getCrawler();
        $this->assertEquals(2, $crawler->filter('li:contains("already in use")')->count());
    }

    private function doLogin($username, $password) {
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('_submit')->form(array(
          '_username'  => $username,
          '_password'  => $password,
        ));
        $this->client->submit($form);

        $this->assertTrue($this->client->getResponse()->isRedirect());

        $crawler = $this->client->followRedirect();
    }

    private function createNetwork($range, $name) {
        $this->client->followRedirects(true);
        $crawler = $this->client->request('GET', '/scan/new');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());


        $form = $crawler->selectButton('Scan')->form(array(
          'appbundle_scan[range]'  => $range,
          'appbundle_scan[store]'  => true,
          'appbundle_scan[name]'  => $name,
        ));

        $this->client->submit($form);
    }
}
