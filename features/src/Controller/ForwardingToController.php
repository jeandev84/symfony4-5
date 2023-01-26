<?php
namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class ForwardingToController extends AbstractController
{


      /**
       * @Route("/forwarding-to-controller")
      */
      public function forwardingToController(): Response
      {
           return $this->forward(
               "App\\Controller\\ForwardingToController::methodToForwardTo",
               ['param' => 1]
           );
      }




      /**
       * @Route("/url-to-forward-to/{params?}", name="route_to_forward_to")
      */
      public function methodToForwardTo($param)
      {
           exit('Test controller forwarding - '. $param);
      }
}