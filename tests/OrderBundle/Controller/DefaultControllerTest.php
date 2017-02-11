<?php

namespace OrderBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/product/view/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
