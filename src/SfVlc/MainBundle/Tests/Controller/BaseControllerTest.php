<?php

namespace SfVlc\MainBundle\Tests\Controller;

use BladeTester\HandyTestsBundle\Model\HandyTestCase;


abstract class BaseControllerTest extends HandyTestCase {

    public function setUp(array $auth = array()) {
        parent::setUp($auth);
        $this->truncateTables(array('users'));
    }

    protected function logInAsNonAdmin() {
        $this->createUser('not_admin', 'password');
        $this->login('not_admin', 'password');
    }

    protected function logInAsAdmin() {
        $this->createUser('admin', 'password', 'ROLE_ADMIN');
        $this->login('admin', 'password');
    }

    protected function createUser($username, $password, $role = 'ROLE_USER') {
        $manager = $this->getService('fos_user.user_manager');
        return $this->create('User', array('manager' => $manager,
                                           'username' => $username,
                                           'password' => $password,
                                           'roles' => array($role)));

    }

    protected function login($username, $password) {
        $crawler = $this->visit('fos_user_security_login');
        $form = $crawler->filter('form#login')->form();
        $form['_username'] = $username;
        $form['_password'] = $password;
        $this->client->submit($form);
    }

}