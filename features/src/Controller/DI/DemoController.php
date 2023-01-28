<?php
namespace App\Controller\DI;

use App\Service\DemoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class DemoController  extends AbstractController
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
        * @Route("/demo", name="demo")
       */
       public function showService(DemoService $demoService)
       {
             dd($demoService);
       }
}