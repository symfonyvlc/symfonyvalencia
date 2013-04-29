<?php

namespace SfVlc\MainBundle\Tests\Controller;

use BladeTester\HandyTestsBundle\Model\HandyTestCase;


class MainControllerTest extends HandyTestCase {


    public function setUp() {
        parent::setUp();
        $this->truncateTables(array('users'));
        //$this->logout();
    }

    /**
     * @test
     */
    public function itShowsALoginLinkWhenNotLoggedIn() {
        // Arrange

        // Act
        $crawler = $this->visit('sf_vlc_main_homepage');

        // Assert
        $this->assertTrue($crawler->filter('a#login-link')->count() > 0);
    }

    /**
     * @test
     */
    public function itShowsARegisterLinkWhenNotLoggedIn() {
        // Arrange

        // Act
        $crawler = $this->visit('sf_vlc_main_homepage');

        // Assert
        $this->assertTrue($crawler->filter('a#register-link')->count() > 0);
    }

    /**
     * @test
     */
    public function itDoesNotShowALoginLinkWhenLoggedIn() {
        // Arrange
        $this->client->followRedirects();
        $user = $this->createUser('test', 'testpass');
        $this->login('test', 'testpass');

        // Act
        $crawler = $this->visit('sf_vlc_main_homepage');

        // Assert
        $this->assertFalse($crawler->filter('a#login-link')->count() > 0);
    }

    /**
     * @test
     */
    public function itShowsALogoutLinkWhenLoggedIn() {
        // Arrange
        $this->client->followRedirects();
        $user = $this->createUser('test', 'testpass');
        $this->login('test', 'testpass');

        // Act
        $crawler = $this->visit('sf_vlc_main_homepage');

        // Assert
        $this->assertTrue($crawler->filter('a#logout-link')->count() > 0);
    }


    private function createUser($username, $password) {
        $userManager = $this->client->getKernel()->getContainer()->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $user->setUserName($username);
        $user->setEmail($username . '@test.is');
        $user->setPlainPassword($password);
        $user->setEnabled(true);
        $userManager->updateUser($user);
        $this->em->flush();
        return $user;
    }

    private function login($username, $password) {
        $crawler = $this->visit('fos_user_security_login');
        $form = $crawler->filter('form#login')->form();
        $form['_username'] = $username;
        $form['_password'] = $password;
        $this->client->submit($form);
    }

    private function logout() {
        $this->visit('fos_user_security_logout');
    }

}
