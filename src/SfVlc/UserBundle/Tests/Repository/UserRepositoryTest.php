<?php

namespace SfVlc\MainBundle\Tests\Controller;

use BladeTester\HandyTestsBundle\Model\HandyTestCase;


class UserRepositoryTest extends HandyTestCase {

    private $repository;

    public function setUp(array $auth = array())
    {
        parent::setUp();
        $this->truncateTables(array('users'));
        $this->repository = $this->em->getRepository('SfVlcUserBundle:User');
    }

    public function tearDown()
    {
        $this->repository = null;
        parent::tearDown();
    }

    /**
     * @test
     */
    public function itBringsUsersByRole()
    {
        // Arrange
        $this->createUserWithRole('ROLE_ONE');
        $this->createUserWithRole('ROLE_TWO');

        // Act
        $users = $this->repository->findAllByRole('ROLE_ONE');

        // Assert
        $this->assertCount(1, $users);
    }

    private function createUserWithRole($role)
    {
        $manager = $this->getService('fos_user.user_manager');
        $this->create('User', array('manager' => $manager,
                                    'roles' => array($role)));
    }

}
