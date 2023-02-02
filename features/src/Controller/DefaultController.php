<?php
namespace App\Controller;

use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{


    protected $entityManager;

    public function __construct(EntityManagerInterface  $entityManager)
    {
          $this->entityManager = $entityManager;
    }



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
     * @Route("/videos", name="videos")
    */
    public function videos(VideoRepository $videoRepository): Response
    {
        $videos = $videoRepository->findAll();

        dd($videos);

        return $this->render('default/video.html.twig', [
            'videos' => $videos,
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
