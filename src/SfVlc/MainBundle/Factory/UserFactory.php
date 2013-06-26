<?php

namespace SfVlc\MainBundle\Factory;

use Doctrine\Common\Persistence\ObjectManager;
use BladeTester\HandyTestsBundle\Model\FactoryInterface;

class UserFactory implements FactoryInterface {

    private $om;

    public function __construct(ObjectManager $om) {
        $this->om = $om;
    }


    public function build(array $attributes)
    {
    }


    public function create(array $attributes)
    {
        $manager = $attributes['manager'];
        $user = $manager->createUser();
        $this->setDefaultFields($user, $attributes);
        $this->addRolesToUser($user, $attributes);
        $manager->updateUser($user);
        $this->om->flush();
        return $manager;
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