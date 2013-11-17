<?php

namespace SfVlc\UserBundle\Factory;

use BladeTester\HandyTestsBundle\Model\FactoryInterface;
use FOS\UserBundle\Model\UserManagerInterface;

class UserFactory implements FactoryInterface {

    private $manager;

    public function __construct(UserManagerInterface $manager) {
        $this->manager = $manager;
    }


    public function getName()
    {
        return 'User';
    }


    public function build(array $attributes)
    {
        $user = $this->manager->createUser();
        $this->setDefaultFields($user, $attributes);
        $this->addRolesToUser($user, $attributes);
        return $user;
    }


    public function create(array $attributes)
    {
        $user = $this->build($attributes);
        $this->manager->updateUser($user);
        return $user;
    }


    private function setDefaultFields($user, array $attributes)
    {
        static $count = 1;
        $username = isset($attributes['username']) ? $attributes['username'] : "user_$count";
        $email = isset($attributes['email']) ? $attributes['email'] : "email_$count@valid.is";
        $password = isset($attributes['password']) ? $attributes['password'] : 'password';
        $user->setUserName($username);
        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setEnabled(true);
        $count++;
    }


    private function addRolesToUser($user, array $attributes)
    {
        if (isset($attributes['roles'])) {
            foreach ($attributes['roles'] as $role) {
                $user->addRole($role);
            }
        }
    }
}