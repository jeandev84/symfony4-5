<?php
namespace App\Controller;

use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ExceptionHandlerController extends AbstractController
{

         public function createExceptionHandler(UserManager $userManager)
         {
              if (! $userManager->findOneUserById(23)) {
                   $this->createNotFoundException('The users does not exist');
              }
         }
}