<?php

namespace UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{

    private $client = null;

    public function setUp()
    {
        $this->client = self::createClient();
    }

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }

    public function testLogin()
    {
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('_submit')->form(array(
            '_username'  => 'kostya',
            '_password'  => '123456789q',
        ));
        $this->client->submit($form);

        $this->assertTrue($this->client->getResponse()->isRedirect());

        $crawler = $this->client->followRedirect();
    }

    public function testRegistration()
    {
        $crawler = $this->client->request('GET', '/register/');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals(1,$crawler->filter('html:contains("Registration form")')->count());
        $form = $crawler->selectButton('Register')->form([
            "fos_user_registration_form[username]" => 'alex',
            "fos_user_registration_form[email]" => 'alex@gmail.com',
            "fos_user_registration_form[plainPassword][first]" => 12345,
            "fos_user_registration_form[plainPassword][second]" => 12345,
        ]);

        $crawler = $this->client->submit($form);

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());

        $crawler = $this->client->followRedirect();
    }


    public function testProfileEdit()
    {
        $crawler = $this->client->request('GET','/profile/edit');
        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testProfile()
    {
        $crawler = $this->client->request('GET','/profile/');
        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testLogout()
    {
        $crawler = $this->client->request('GET','/logout');
        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }
}
