<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Event\VideoCreatedEvent;

class VideoCreatedSubscriber implements EventSubscriberInterface
{
    public function onVideoCreatedEvent(VideoCreatedEvent $event)
    {
         dump($event->video->title);
    }

    public static function getSubscribedEvents()
    {
        return [
            'video.created.event' => 'onVideoCreatedEvent',
        ];
    }
}
