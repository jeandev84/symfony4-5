<?php
namespace App\Service\Upload;

use App\Service\Upload\Contract\FileUploaderInterface;

class VimeoFileUploader implements FileUploaderInterface
{

    public function __construct()
    {
        dump("Upload file from Vimeo Server");
    }

    public function upload($file)
    {
        dump("Upload file from Vimeo Server");
    }

    public function delete($file)
    {
        // TODO: Implement delete() method.
    }
}