<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VideoFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setName('Audrey');

        for ($i = 1; $i <= 3; $i++) {
           $video = new Video();
           $video->setTitle("Video title -". $i);
           $manager->persist($video);
           $user->addVideo($video);
        }

        $manager->persist($user);
        $manager->flush();

        dump('Created a user with the id of '. $user->getId());
    }
}
