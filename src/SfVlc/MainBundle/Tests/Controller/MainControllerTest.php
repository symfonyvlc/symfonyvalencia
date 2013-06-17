<?php

namespace SfVlc\MainBundle\Tests\Controller;

class MainControllerTest extends BaseControllerTest {


    public function setUp() {
        parent::setUp();
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
        $this->loginAsNonAdmin();

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
        $this->loginAsNonAdmin();

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

    /**
     * @test
     */
    public function itShowsPostsInTheHomePage() {
        // Arrange
        $this->truncateTables(array('news'));
        $post_manager = $this->getService('blade_tester_light_news.news_manager');
        $post_manager->create();
        $post_manager->create();
        $post_manager->create();

        // Act
        $crawler = $this->visit('sf_vlc_main_homepage');

        // Assert
        $this->assertEquals(3, $crawler->filter('.post')->count());
    }

}
