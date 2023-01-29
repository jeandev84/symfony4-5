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
//            'video.created.event' => 'onVideoCreatedEvent',
//            // KernelEvents::RESPONSE => 'onKernelResponse'
//            KernelEvents::RESPONSE => [
//                ['onKernelResponse1', 2],
//                ['onKernelResponse2', 1], // this will be called first because it has higher priority number
//            ]
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


    public function onKernelResponse1(ResponseEvent $event)
    {
          dump("Called ". __METHOD__);
    }


    public function onKernelResponse2(ResponseEvent $event)
    {
         dump("Called ". __METHOD__);
    }
}
