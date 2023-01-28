<?php
namespace App\Controller\Container;

use App\Service\DemoService;
use App\Service\MyFirstService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class ServiceController  extends AbstractController
{

       /**
        * @var DemoService
       */
       protected $demoService;


       /**
        * @param DemoService $demoService
       */
       public function __construct(DemoService $demoService)
       {
            $this->demoService = $demoService;
       }



       /**
        * @Route("/demo-service", name="demo.service")
       */
       public function showService(DemoService $demoService)
       {
             dd($demoService);
       }



      /**
       * @Route("/first-service", name="first.service")
      */
       public function showMyFirstService(MyFirstService $firstService)
       {
             // dd($firstService);

             dd($firstService->someAction());
       }
}