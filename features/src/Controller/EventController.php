<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Event\VideoCreatedEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;



class EventController extends AbstractController
{

       protected $eventDispatcher;


       public function __construct(EventDispatcherInterface $eventDispatcher)
       {
            $this->eventDispatcher = $eventDispatcher;
       }




       /**
        * @Route("/app/video/create", name="video.create")
       */
       public function dispatchVideoEventAfterCreating(): JsonResponse
       {
             $video = new \stdClass();
             $video->title = 'Funny movie';
             $video->category = 'funny';

             $event = new VideoCreatedEvent($video);
             $this->eventDispatcher->dispatch($event, VideoCreatedEvent::NAME);


             // dd('Dispatching');

             return new JsonResponse(['success' => "Video successfully created and dispatched"]);
       }
}