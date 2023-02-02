<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/app", name="app")
    */
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }




    /**
     * @Route("/awesome-form", name="awesomeform")
    */
    public function awesomeLink(): Response
    {
        return $this->render('default/awesome/form.html.twig');
    }
}
