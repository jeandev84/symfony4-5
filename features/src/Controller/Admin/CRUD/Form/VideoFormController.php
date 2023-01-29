<?php
namespace App\Controller\Admin\CRUD\Form;

use App\Entity\Video;
use App\Form\VideoFormType;
use App\Manager\UserManager;
use App\Manager\VideoManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class VideoFormController extends AbstractController
{


    /**
     * @var VideoManager
     */
    protected $videoManager;



    /**
     * @var UserManager
     */
    protected $userManager;



    /**
     * @param VideoManager $videoManager
     * @param UserManager $userManager
    */
    public function __construct(VideoManager $videoManager, UserManager $userManager)
    {
        $this->videoManager = $videoManager;
        $this->userManager  = $userManager;
    }




    /**
     * @Route("/admin/videos/form/create", name="admin.videos.form.create", methods={"GET", "POST"})
    */
    public function createVideoForm(Request $request): Response
    {
        $videos = $this->videoManager->getVideos();
        dump($videos);

        $video = new Video();

        /*
        $video->setTitle('Write a blog post');
        $video->setCreatedAt(new \DateTime('tomorrow'));
        */

        $form = $this->createForm(VideoFormType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // dump($form->getData());

            $this->videoManager->saveVideo($video);
            return $this->redirectToRoute('admin.videos.form.create');
        }


        return $this->render("admin/video/form.html.twig", [
            'form' => $form->createView()
        ]);
    }





    /**
     * @Route("/admin/videos/form/update", name="admin.videos.form.update", methods={"GET", "POST"})
    */
    public function updateVideoForm(Request $request): Response
    {
        $video = $this->videoManager->findVideo(1);

        $form = $this->createForm(VideoFormType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // dump($form->getData());

            /** @var UploadedFile $file */
            $file = $form->get('file')->getData();
            $fileName = sha1(random_bytes(14)) . '.' . $file->guessExtension();
            $file->move($this->getParameter('videos_directory'), $fileName);
            $video->setFile($file);

            $this->videoManager->saveVideo($video);
            return $this->redirectToRoute('admin.videos.form.update');
        }


        return $this->render("admin/video/form.html.twig", [
            'form' => $form->createView()
        ]);
    }
}