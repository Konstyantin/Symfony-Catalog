<?php

namespace ProductBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/product/index');

        $this->assertContains('ProductController', $client->getResponse()->getContent());
    }

    public function testView()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/product/view/Product');
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertCount(1, $crawler->filter('h2.text-center'));
        $this->assertCount(1, $crawler->filter('p.description'));
        $this->assertCount(1, $crawler->filter('p.price'));
        $this->assertCount(1, $crawler->filter('a.btn'));
        
        $this->assertContains('Product', $client->getResponse()->getContent());
        $this->assertContains('Product description', $client->getResponse()->getContent());
        $this->assertContains('2000.00', $client->getResponse()->getContent());

        $link = $crawler->filter('a.btn')->link();
        
        $crawler = $client->click($link);
    }

    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/product/list');
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertGreaterThan(0, $crawler->filter('h2.text-center')->count());
        $this->assertGreaterThan(0, $crawler->filter('img')->count());
    }
}
