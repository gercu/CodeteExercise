<?php

namespace App\Repository;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ODM\MongoDB\DocumentRepository;

class UserRepository extends DocumentRepository implements UserLoaderInterface {

    public function loadUserByUsername($username) {

        return $this->createQueryBuilder('App:User')
                        ->field('username')->equals($username)
                        ->getQuery()->execute();
    }

}
