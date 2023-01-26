<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ErrorPageController extends AbstractController
{

     /**
      * @Route("/do_some_errors", name="do.some.errors")
     */
     public function index()
     {
          /* return new Response($thisVariableDoesNotExist); */

          $title = 'Example Title';

          return $this->render('errors/page', [
              'something' => $title23
          ]);
     }
}