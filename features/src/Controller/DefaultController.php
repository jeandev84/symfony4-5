<?php
namespace App\Controller;

use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;



class DefaultController extends AbstractController
{


    protected $entityManager;

    protected $eventDispatcher;

    public function __construct(
        EntityManagerInterface  $entityManager,
        EventDispatcherInterface $eventDispatcher)
    {
          $this->entityManager = $entityManager;
          $this->eventDispatcher = $eventDispatcher;
    }



    /**
     * @Route("/app", name="app")
    */
    public function index(Request $request, TranslatorInterface $translator): Response
    {

        $translated = $translator->trans('form.login.username');

        dump($translated);
        dump($request->getLocale());


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
