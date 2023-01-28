<?php
namespace App\Controller\Admin\CRUD;


use App\Entity\Inheritance\Author;
use App\Entity\Inheritance\File;
use App\Entity\Inheritance\Files\PdfFile;
use App\Entity\Inheritance\Files\VideoFile;
use App\Repository\Inheritance\AuthorRepository;
use App\Repository\Inheritance\Files\PdfFileRepository;
use App\Repository\Inheritance\Files\VideoFileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class FileCrudController extends AbstractController
{


    /**
     * @var EntityManagerInterface
    */
    protected $entityManager;


    /**
     * @param EntityManagerInterface $entityManager
    */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }




    /**
     * @Route("/admin/author/pdf-files", name="admin.author.pdf-files", methods={"GET"})
    */
    public function getAuthorPdfFiles(PdfFileRepository $pdfFileRepository): Response
    {
        $items = $pdfFileRepository->findAll();
        dump($items);

        return $this->render('admin/files/author/pdf.html.twig', [
            'items' => $items
        ]);
    }



    /**
     * @Route("/admin/author/video-files", name="admin.author.video-files", methods={"GET"})
     */
    public function getAuthorVideoFiles(VideoFileRepository $videoFileRepository): Response
    {
        $items = $videoFileRepository->findAll();

        dump($items);

        return $this->render('admin/files/author/video.html.twig', [
            'items' => $items
        ]);
    }


    /**
     * @Route("/admin/author/files", name="admin.author.files", methods={"GET"})
     * @throws NonUniqueResultException
     */
    public function getAuthorFiles(AuthorRepository $authorRepository): Response
    {
        /*
        $items = $this->entityManager->getRepository(File::class)->findAll();
        dump($items);

        $items = $this->entityManager->getRepository(File::class)->find(2);
        dump($items);

         $author = $this->entityManager->getRepository(Author::class)->find(1);

        dump($author);

        foreach ($author->getFiles() as $file) {
               if ($file instanceof PdfFile) {
                   dump($file->getOrientation());
                   dump($file->getPagesNumber());
               } elseif ($file instanceof VideoFile) {
                   dump($file->getFormat());
                   dump($file->getDuration());
               }

               dump($file->getFilename());
        }
        */


        /** @var Author $author */
        $author = $authorRepository->findByIdWithPdfFiles(1);

        dump($author);

        /** @var PdfFile $pdfFile */
        foreach ($author->getFiles() as $pdfFile) {
             dump($pdfFile->getFilename());
             dump($pdfFile->getOrientation());
        }

        return $this->render('admin/files/author/files.html.twig');
    }
}