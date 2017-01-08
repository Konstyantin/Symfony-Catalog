<?php

namespace CatalogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertGreaterThan(0, $crawler->filter('h2.text-center')->count());
        $this->assertGreaterThan(0, $crawler->filter('img')->count());
    }
}
