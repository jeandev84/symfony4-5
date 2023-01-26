<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PageController extends AbstractController
{


     /**
      * @Route("/page", name="page")
     */
     public function index(Request $request)
     {
          return $this->render('page/index.html.twig', [
              'title'      => 'Page Controller',
              'announce'   => 'AWS First Magazine',
          ]);
     }
}