<?php

namespace SfVlc\MainBundle\Tests\Controller;

class AdminControllerTest extends BaseControllerTest {

    public function setUp() {
        parent::setUp();
        $this->truncateTables(array('users'));
    }

    /**
     * @test
     */
    public function IShouldNotAccessToTheAdminInterfaceIfNotAdmin() {
        // Arrange
        $not_admin = $this->createUser('not_admin', 'password');
        $this->login('not_admin', 'password');

        // Act
        $crawler = $this->visit('sf_vlc_admin_homepage');

        // Assert
        $this->assertFalse($this->client->getResponse()->isSuccessful());
    }

    /**
     * @test
     */
    public function IShouldAccessToTheAdminInterfaceIfAdmin() {
        // Arrange
        $admin = $this->createUser('admin', 'password', 'ROLE_ADMIN');
        $this->login('admin', 'password');

        // Act
        $crawler = $this->visit('sf_vlc_admin_homepage');

        // Assert
        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }
}