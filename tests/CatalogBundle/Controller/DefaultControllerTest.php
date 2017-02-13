<?php

namespace CatalogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tests\AbstractControllerTest;

class DefaultControllerTest extends AbstractControllerTest
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertGreaterThan(0, $crawler->filter('h2.text-center')->count());
        $this->assertGreaterThan(0, $crawler->filter('img')->count());
    }

    public function testClickProduct()
    {
        $crawler = $this->client->request('GET', '/en/');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $linkBack = $crawler->selectLink('Products')->link();

        $this->client->click($linkBack);

        $this->client->followRedirects(true);
    }

    public function testClickCatalog()
    {
        $crawler = $this->client->request('GET', '/en/');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $linkBack = $crawler->selectLink('Catalog')->link();

        $this->client->click($linkBack);

        $this->client->followRedirects(true);
    }
}
