<?php
namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



class LogoutController extends AbstractController
{

     /**
      * @Route("/logout", name="logout")
     */
     public function logout()
     {
          // You don't need to do something here!
     }
}