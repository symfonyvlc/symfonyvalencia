<?php

namespace SfVlc\MainBundle\Tests\Controller;

use BladeTester\HandyTestsBundle\Model\HandyTestCase;


abstract class BaseControllerTest extends HandyTestCase {

    public function setUp(array $auth = array()) {
        parent::setUp($auth);
    }


    protected function createUser($username, $password, $role = 'ROLE_USER') {
        $userManager = $this->client->getKernel()->getContainer()->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $user->setUserName($username);
        $user->setEmail($username . '@test.is');
        $user->setPlainPassword($password);
        $user->setEnabled(true);
        $user->addRole($role);
        $userManager->updateUser($user);
        $this->em->flush();
        return $user;
    }

    protected function login($username, $password) {
        $crawler = $this->visit('fos_user_security_login');
        $form = $crawler->filter('form#login')->form();
        $form['_username'] = $username;
        $form['_password'] = $password;
        $this->client->submit($form);
    }
}