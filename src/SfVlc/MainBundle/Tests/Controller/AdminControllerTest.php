<?php

namespace SfVlc\MainBundle\Tests\Controller;

class AdminControllerTest extends BaseControllerTest {

    public function setUp() {
        parent::setUp();
    }

    /**
     * @test
     */
    public function IShouldNotAccessToTheAdminInterfaceIfNotAdmin()
    {
        // Arrange
        $this->logInAsNonAdmin();

        // Act
        $crawler = $this->visit('sf_vlc_admin_homepage');

        // Assert
        $this->assertFalse($this->client->getResponse()->isSuccessful());
    }



    /**
     * @test
     */
    public function IShouldAccessToTheAdminInterfaceIfAdmin()
    {
        // Arrange
        $this->logInAsAdmin();

        // Act
        $crawler = $this->visit('sf_vlc_admin_homepage');

        // Assert
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }


    /**
     * @test
     */
    public function IShouldAccessToTheListOfPosts()
    {
        // Arrange
        $this->logInAsAdmin();
        $this->truncateTables(array('news'));
        $post_manager = $this->getService('blade_tester_light_news.news_manager');
        $post_manager->create('One title');
        $post_manager->create('Other title');
        $this->em->flush();

        // Act
        $crawler = $this->visit('sf_vlc_admin_posts');

        // Assert
        $posts_shown = $crawler->filter('.post')->count();
        $this->assertEquals(2, $posts_shown);
    }
}