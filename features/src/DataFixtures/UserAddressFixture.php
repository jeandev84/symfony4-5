<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserAddressFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $user = new User();
        $user->setName('John');

        $address = new Address();
        $address->setStreet('street');
        $address->setNumber(23);
        $user->setAddress($address);

        // cascade={"persist"} mean that, you don't need to persist again $address
        // Because address will be automatically created when create a new $user
        // $entityManager->persist($address);
        $manager->persist($user);
        $manager->flush();
    }
}
