<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Event\VideoCreatedEvent;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class VideoCreatedSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            'video.created.event' => 'onVideoCreatedEvent',
            KernelEvents::RESPONSE => 'onKernelResponse'
        ];
    }




    public function onVideoCreatedEvent(VideoCreatedEvent $event)
    {
        dump($event->video->title);
    }



    public function onKernelResponse(ResponseEvent $event)
    {
         $responsePrevious = $event->getResponse();

         $content = \json_decode($event->getResponse()->getContent(), true)['success'];

         $content .= " and response modified by [" . __METHOD__ . "]";

         $response = new JsonResponse(["success" => $content]);

         $event->setResponse($response);
    }
}
