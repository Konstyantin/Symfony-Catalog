<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 08.01.17
 * Time: 21:35
 */

namespace ProductBundle\Tests\Controller;

use Tests\AbstractControllerTest;

class AdminControllerTest extends AbstractControllerTest
{
    public function testList()
    {
        $crawler = $this->client->request('GET', '/en/admin/product/product/list');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertCount(1, $crawler->filter('section.sidebar'));

        $this->assertGreaterThan(0, $crawler->filter('tr')->count());

        $this->assertGreaterThan(0, $crawler->filter('html:contains("Product")')->count());
    }

    public function testCreate()
    {
        $crawler = $this->client->request('GET', '/en/admin/product/product/create');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertCount(1, $crawler->filter('section.sidebar'));

        $this->assertCount(1, $crawler->filter('span:contains("Enter name product")'));
        $this->assertCount(1, $crawler->filter('span:contains("Enter price product")'));
        $this->assertCount(1, $crawler->filter('span:contains("Enter description product")'));

        $this->assertCount(3, $crawler->filter('button:contains("Create")'));
        $this->assertCount(1, $crawler->filter('button:contains("Create and return to list")'));
        $this->assertCount(1, $crawler->filter('button:contains("Create and add another")'));
        $this->assertCount(3, $crawler->filter('button.btn-success'));

        $this->assertCount(1, $crawler->filter('section.sidebar'));
    }

    public function testUpdate()
    {
        $crawler = $this->client->request('GET', '/en/admin/product/product/4/edit');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertCount(1, $crawler->filter('section.sidebar'));

        $this->assertCount(1, $crawler->filter('span:contains("Enter name product")'));
        $this->assertCount(1, $crawler->filter('span:contains("Enter price product")'));
        $this->assertCount(1, $crawler->filter('span:contains("Enter description product")'));

        $this->assertCount(2, $crawler->filter('button:contains("Update")'));
        $this->assertCount(1, $crawler->filter('button:contains("Update and close")'));
        $this->assertCount(1, $crawler->filter('a:contains("Delete")'));

        $this->assertCount(1, $crawler->filter('html:contains("Lumia 950")'));

        $this->assertCount(1, $crawler->filter('section.sidebar'));
    }
}
