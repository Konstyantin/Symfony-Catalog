<?php

namespace OrderBundle\Tests\Controller;

use Tests\AbstractControllerTest;

class DefaultControllerTest extends AbstractControllerTest
{
    public function testProductViewBack()
    {
        $crawler = $this->client->request('GET', '/en/product/view/1');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertCount(1, $crawler->filter('img'));
        $this->assertCount(1, $crawler->filter('h2.text-center:contains("Galaxy S7")'));
        $this->assertCount(1, $crawler->filter('a.btn-success:contains("Buy")'));
        $this->assertCount(1, $crawler->filter('a.btn-primary:contains("Back")'));
        $this->assertCount(1, $crawler->filter('p.description'));

        $linkBack = $crawler->selectLink('Back')->link();

        $this->client->click($linkBack);

        $this->client->followRedirects(true);
    }

    public function testProductViewBuy()
    {
        $crawler = $this->client->request('GET', '/en/product/view/1');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertCount(1, $crawler->filter('img'));
        $this->assertCount(1, $crawler->filter('h2.text-center:contains("Galaxy S7")'));
        $this->assertCount(1, $crawler->filter('a.btn-success:contains("Buy")'));
        $this->assertCount(1, $crawler->filter('a.btn-primary:contains("Back")'));
        $this->assertCount(1, $crawler->filter('p.description'));

        $linkBack = $crawler->selectLink('Buy')->link();

        $this->client->click($linkBack);

        $this->client->followRedirects(true);
    }

    public function testConfirmOrderIndex()
    {
        $crawler = $this->client->request('GET', '/en/order/index');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertCount(1, $crawler->filter('h2:contains("Order index")'));

        $this->assertCount(1, $crawler->filter('tr:contains("Name")'));
        $this->assertCount(1, $crawler->filter('tr:contains("Price")'));
        $this->assertCount(1, $crawler->filter('tr:contains("Quantity")'));
        $this->assertCount(1, $crawler->filter('tr:contains("Change")'));

        $this->assertCount(1, $crawler->filter('table.table'));
        $this->assertCount(1, $crawler->filter('td:contains("Galaxy S7")'));
        $this->assertCount(1, $crawler->filter('td.price:contains("2000.00")'));
        $this->assertCount(1, $crawler->filter('td.quantity:contains("2")'));
        $this->assertCount(1, $crawler->filter('td > a.btn-danger:contains("Delete")'));

        $this->assertCount(1, $crawler->filter('td.amount:contains("4000.00")'));

        $linkConfirm = $crawler->selectLink('Confirm')->link();

        $this->client->click($linkConfirm);

        $this->client->followRedirects(true);
    }

    public function testDeleteOrderIndex()
    {
        $crawler = $this->client->request('GET', '/en/order/index');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertCount(1, $crawler->filter('h2:contains("Order index")'));

        $this->assertCount(1, $crawler->filter('tr:contains("Name")'));
        $this->assertCount(1, $crawler->filter('tr:contains("Price")'));
        $this->assertCount(1, $crawler->filter('tr:contains("Quantity")'));
        $this->assertCount(1, $crawler->filter('tr:contains("Change")'));

        $this->assertCount(1, $crawler->filter('table.table'));
        $this->assertCount(1, $crawler->filter('td:contains("Galaxy S7")'));
        $this->assertCount(1, $crawler->filter('td.price:contains("2000.00")'));
        $this->assertCount(1, $crawler->filter('td.quantity:contains("2")'));
        $this->assertCount(1, $crawler->filter('td > a.btn-danger:contains("Delete")'));

        $this->assertCount(1, $crawler->filter('td.amount:contains("4000.00")'));

        $linkConfirm = $crawler->selectLink('Delete')->link();

        $this->client->click($linkConfirm);

        $this->client->followRedirects(true);
    }

    public function testConfirmOrder()
    {
        $crawler = $this->client->request('GET', '/en/order/confirm/2');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertCount(1, $crawler->filter('h2:contains("Confirm order")'));

        $form = $crawler->selectButton('Submit')->form([
            'confirm[phone]' => '380669936025',
        ]);

        $crawler = $this->client->submit($form);

        $this->client->followRedirects(true);
    }
}
