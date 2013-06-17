<?php

namespace SfVlc\MainBundle\Tests\Controller;

class MainControllerTest extends BaseControllerTest {


    public function setUp() {
        parent::setUp();
        $this->truncateTables(array('users'));
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


    /**
     * @test
     */
    public function itShowsALinkToTheIntranet() {
        // Arrange

        // Act
        $crawler = $this->visit('sf_vlc_main_homepage');

        // Assert
        $this->assertTrue($crawler->filter('a#intranet-link')->count() > 0);
    }

}
