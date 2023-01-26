<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class RedirectController extends AbstractController
{


       /**
        * @Route("/redirect-to")
       */
       public function redirectToSomewhere(): \Symfony\Component\HttpFoundation\RedirectResponse
       {
             return $this->redirectToRoute('route_to_redirect', ['params' => 20]);
       }




      /**
       * @Route("/url-to-redirect/{params?}", name="route_to_redirect")
      */
      public function urlToRedirect()
      {
            exit('Test redirection');
      }
}