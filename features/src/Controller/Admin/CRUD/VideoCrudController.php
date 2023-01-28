<?php
namespace App\Controller\Admin\CRUD;

use App\Manager\VideoManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class VideoCrudController extends AbstractController
{

     /**
      * @var VideoManager
     */
     protected $videoManager;


     public function __construct(VideoManager $videoManager)
     {
          $this->videoManager = $videoManager;
     }
}