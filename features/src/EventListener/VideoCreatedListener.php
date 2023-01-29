<?php
namespace App\EventListener;

use App\Event\VideoCreatedEvent;

class VideoCreatedListener
{


     public function onVideoCreatedEvent(VideoCreatedEvent $event)
     {
           // dump($event->getVideo());

           dump($event->video->title);
     }
}