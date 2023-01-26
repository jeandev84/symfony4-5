<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class UrlGeneratorController extends AbstractController
{


         /**
          * @Route("/generate_url/{param?}", name="generate_url")
         */
         public function generateSomeUrl()
         {
              // http://localhost:8000/generate_url
              exit($this->generateUrl('generate_url', ['param' => 10], UrlGeneratorInterface::ABSOLUTE_URL));
         }
}