<?php
namespace App\Tests\Controllers\Admin;

use App\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Tests\RoleAdmin;


class AdminControllerVideosTest extends WebTestCase
{
      use RoleAdmin;



      public function testDeleteVideo()
      {
            $this->client->request('GET', '/admin/superadmin/delete-video/11/289729765');

            $video = $this->entityManager->getRepository(Video::class)->find(11);

            $this->assertNull($video);
      }
}