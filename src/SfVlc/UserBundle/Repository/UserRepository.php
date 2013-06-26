<?php

namespace SfVlc\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;


class UserRepository extends EntityRepository {

    public function findAllByRole($role)
    {
        return $this->getEntityManager()
                ->createQuery('SELECT u
                               FROM SfVlcUserBundle:User u
                               WHERE u.roles LIKE :role')
                ->setParameters(array(
                  'role' => "%$role%",
                ))
                ->getResult();
    }
}