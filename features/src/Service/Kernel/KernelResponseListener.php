<?php
namespace App\Service\Kernel;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;


class KernelResponseListener
{

     public function onKernelResponse(ResponseEvent $event)
     {
         // This implementation will modify the kernel.response

          $response = new Response('some modification response content');

          $event->setResponse($response);
     }
}