<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Inheritance\Author;
use App\Entity\Inheritance\Files\PdfFile;
use App\Entity\Inheritance\Files\VideoFile;



class InheritanceEntitiesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 2; $i++) {

            $author = new Author();
            $author->setName('author name '. $i);
            $manager->persist($author);

            for ($j = 1; $j <= 3; $j++) {

                 $pdfFile = new PdfFile();
                 $pdfFile->setFilename('pdf name of user '. $i);
                 $pdfFile->setDescription('pdf description of user '. $i);
                 $pdfFile->setSize(5454);
                 $pdfFile->setOrientation('portrait');
                 $pdfFile->setPagesNumber(123);
                 $pdfFile->setAuthor($author);
                 $manager->persist($pdfFile);
            }


            for ($k = 1; $k <= 2; $k++) {

                $videoFile = new VideoFile();
                $videoFile->setFilename('video name of user '. $i);
                $videoFile->setDescription('video description of user '. $i);
                $videoFile->setSize(321);
                $videoFile->setFormat('mpeg-2');
                $videoFile->setDuration(123);
                $videoFile->setAuthor($author);
                $manager->persist($videoFile);
            }

        }

        $manager->flush();
    }
}
