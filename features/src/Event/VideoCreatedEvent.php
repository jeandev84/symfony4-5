<?php
namespace App\Event;

# use Symfony\Component\EventDispatcher\Event;
# use App\Entity\Video;
use Symfony\Contracts\EventDispatcher\Event;

class VideoCreatedEvent extends Event
{

     const NAME = 'video.created.event';

     /**
      * @var \stdClass
     */
     public $video;



     public function __construct($video)
     {
          $this->video = $video;
     }


     public function getVideo(): \stdClass
     {
          return $this->video;
     }
}