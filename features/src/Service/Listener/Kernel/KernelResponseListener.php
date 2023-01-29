<?php
namespace App\Service\Listener\Kernel;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;


class KernelResponseListener
{

     public function onKernelResponse(ResponseEvent $event)
     {
         // This implementation will modify the kernel.response

          $response = new Response('some modification response content form ['. __METHOD__ . ']');

          $event->setResponse($response);
     }
}