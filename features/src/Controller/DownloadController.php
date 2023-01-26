<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DownloadController extends AbstractController
{

    /**
     * @Route("/download", name="download")
    */
    public function generateSomeUrl(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
         $path = $this->getParameter('download_directory');

         return $this->file("{$path}/contract-note.pdf");
    }
}