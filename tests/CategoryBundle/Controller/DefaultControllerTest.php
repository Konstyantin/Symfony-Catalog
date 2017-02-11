<?php

namespace CategoryBundle\Tests\Controller;

use Tests\AbstractControllerTest;

class DefaultControllerTest extends AbstractControllerTest
{
    public function testAdminDashboard()
    {
        $crawler = $this->client->request('GET', '/en/admin/dashboard');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Catalog")')->count());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

    }

    public function testCategoryList()
    {
        $crawler = $this->client->request('GET', '/en/admin/category/category/list');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertCount(1, $crawler->filter('section.sidebar'));

        $this->assertCount(6,$crawler->filter('tr'));

        $this->assertCount(1, $crawler->filter('a:contains("Samsung")'));
        $this->assertCount(1, $crawler->filter('a:contains("Microsoft")'));
        $this->assertCount(1, $crawler->filter('a:contains("Apple")'));
        $this->assertCount(1, $crawler->filter('a:contains("Meizu")'));
    }

    public function testCreate()
    {
        $crawler = $this->client->request('GET', '/en/admin/category/category/create');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertCount(1, $crawler->filter('section.sidebar'));

        $this->assertGreaterThan(0, $crawler->filter('html:contains("Enter name category")')->count());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Create")')->count());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Create and return to list")')->count());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Create and add another")')->count());

        $this->assertCount(3, $crawler->filter('button.btn-success'));

        $this->assertGreaterThan(1, $crawler->filter('input')->count());
    }
    
    public function testUpdate()
    {
        $crawler = $this->client->request('GET', '/en/admin/category/category/1/edit');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertCount(1, $crawler->filter('section.sidebar'));

        $this->assertCount(1, $crawler->filter('span:contains("Enter name category")'));
        $this->assertCount(2, $crawler->filter('button:contains("Update")'));
        $this->assertCount(1, $crawler->filter('button:contains("Update and close")'));
        $this->assertCount(1, $crawler->filter('html:contains("Delete")'));
    }
}
