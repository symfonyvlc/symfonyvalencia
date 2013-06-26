<?php

namespace SfVlc\MainBundle\Tests\Controller;

class MembersControllerTest extends BaseControllerTest {


    public function setUp() {
        parent::setUp();
    }

    /**
     * @test
     */
    public function itShowsAListOfMembers() {
        // Arrange
        $this->createUser('member1', 'pass1', 'ROLE_MEMBER');
        $this->createUser('member2', 'pass1', 'ROLE_MEMBER');
        $this->createUser('not a member', 'pass1', 'ROLE_USER');

        // Act
        $crawler = $this->visit('sf_vlc_main_members');

        // Assert
        $this->assertEquals(2, $crawler->filter('.member')->count());
    }
}