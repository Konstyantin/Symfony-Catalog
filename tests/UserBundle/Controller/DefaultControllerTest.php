<?php

namespace UserBundle\Tests\Controller;

use Tests\AbstractControllerTest;

class DefaultControllerTest extends AbstractControllerTest
{
    public function testProfile()
    {
        $crawler = $this->client->request('GET', '/en/profile/');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertCount(1, $crawler->filter('div.alert-success'));
        $this->assertContains('Username: kostya', $this->client->getResponse()->getContent());
        $this->assertContains('Email: kostya_nagula@mail.ua', $this->client->getResponse()->getContent());
    }

    public function testEdit()
    {
        $crawler = $this->client->request('GET', '/en/profile/edit');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertCount(1, $crawler->filter('h2:contains("Profile Edit")'));

        $form = $crawler->selectButton('Update')->form([
            "fos_user_profile_form[username]" => 'kostya',
            "fos_user_profile_form[email]" => 'kostya_nagula@mail.ua',
            "fos_user_profile_form[current_password]" => '123456789qs',
        ]);

        $crawler = $this->client->submit($form);

        $this->assertTrue($this->client->getResponse()->isRedirect('/en/profile/'));
    }

    public function testChanePassword()
    {
        $crawler = $this->client->request('GET', '/en/profile/change-password');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertCount(1, $crawler->filter('h2:contains("Change password")'));

        $form = $crawler->selectButton('Change password')->form([
            "fos_user_change_password_form[current_password]" => '123456789q',
            "fos_user_change_password_form[plainPassword][first]" => '123456789qs',
            "fos_user_change_password_form[plainPassword][second]" => '123456789qs',
        ]);

        $crawler = $this->client->submit($form);

        $this->assertTrue($this->client->getResponse()->isRedirect('/en/profile/'));
    }

    public function testLogin()
    {
        $crawler = $this->client->request('GET', '/en/login');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertCount(1, $crawler->filter('h2:contains("Login form")'));

        $form = $crawler->selectButton('_submit')->form([
            '_username' => 'kostya',
            '_password' => '123456789qs'
        ]);

        $crawler = $this->client->submit($form);

        $crawler = $this->client->request('GET', '/en/profile/');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testLogout()
    {
        $crawler = $this->client->request('GET', '/en/logout');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());

        $crawler = $this->client->request('GET', '/en/profile/');

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testRegister()
    {
        $crawler = $this->client->request('GET', '/en/register/');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Register')->form([
            'fos_user_registration_form[username]' => 'testName',
            'fos_user_registration_form[email]'    => 'testEmail@mail.com',
            'fos_user_registration_form[plainPassword][first]' => 'testPass',
            'fos_user_registration_form[plainPassword][second]' => 'testPass',
        ]);
        
        $this->client->submit($form);

        $crawler = $this->client->request('GET', '/en/profile/');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}
