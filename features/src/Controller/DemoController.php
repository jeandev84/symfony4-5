<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DemoController extends AbstractController
{


     protected $logger;


     public function __construct($logger)
     {
          $this->logger = $logger;
     }




    /**
      * @Route("/demo", name="demo")
     */
     public function index(): Response
     {
          return new Response("Demo Controller.");
     }
}