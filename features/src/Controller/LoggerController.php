<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class LoggerController extends AbstractController
{


    protected $logger;


    public function __construct($logger)
    {
        $this->logger = $logger;
    }




    /**
     * @Route("/log", name="log")
     */
    public function logSomething(): Response
    {
        return new Response("Log something.!");
    }
}