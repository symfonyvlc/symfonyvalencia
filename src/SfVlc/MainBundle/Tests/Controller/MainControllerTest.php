<?php

namespace SfVlc\MainBundle\Tests\Controller;

use BladeTester\HandyTestsBundle\Model\HandyTestCase;


class MainControllerTest extends HandyTestCase {


    public function setUp() {
        parent::setUp();
    }

    /**
     * @test
     */
    public function itShowsALoginFormWhenNotLoggedIn() {
        // Arrange

        // Act
        $crawler = $this->visit('sf_vlc_main_homepage');

        // Assert
        $this->assertTrue($crawler->filter('form#login')->count() > 0);
    }
}
