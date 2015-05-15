<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ImportControllerTest extends WebTestCase {

    public function testCompleteScenario()
    {
        // Create a new client
        $client = static::createClient();

        $xml = file_get_contents(getcwd().'/src/AppBundle/Tests/Resources/ImportControllerTestData.xml');
        $client->request(
          'POST',
          '/import/',
          array(),
          array(),
          array('CONTENT_TYPE' => 'text/xml'),
          $xml
        );

        $this->assertEquals(
          200,
          $client->getResponse()->getStatusCode(),
          "Unexpected HTTP status code for POST /import/"
        );
    }
}
