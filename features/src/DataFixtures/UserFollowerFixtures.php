<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFollowerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 4; $i++) {
             $user = new User();
             $user->setName('Robert -'. $i);
             $manager->persist($user);
        }

        $manager->flush();

        dump('Last user id - '. $user->getId());
    }
}
