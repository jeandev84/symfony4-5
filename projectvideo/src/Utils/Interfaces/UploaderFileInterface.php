<?php
namespace App\Utils\Interfaces;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface UploaderFileInterface
{
       public function upload(UploadedFile $file);
       public function delete($path);
}