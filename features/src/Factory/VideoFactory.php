<?php
namespace App\Factory;

use App\Entity\Video;

class VideoFactory
{

    public function createVideo(): Video
    {
         return new Video();
    }
}