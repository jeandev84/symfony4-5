<?php
namespace App\Controller\Translation;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;



class TranslationController extends AbstractController
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
     * @Route("/translation-in-controller", name="translation.in.controller")
    */
    public function translationInController(Request $request, TranslatorInterface $translator): Response
    {

        $translated = $translator->trans('form.login.username');

        dump($translated);
        dump($request->getLocale());


        return $this->render('translation/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }


    /**
     * @Route({
     *   "en": "/translate-url",
     *   "fr": "/traduction-de-lien",
     *   "ru": "/perevod-silka"
     * }, name="translation.route")
     * @param Request $request
     * @param TranslatorInterface $translator
     * @return Response
    */
    public function translationRoute(Request $request, TranslatorInterface $translator): Response
    {

        return $this->render('translation/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}