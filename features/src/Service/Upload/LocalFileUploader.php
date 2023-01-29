<?php
namespace App\Service\Upload;

use App\Service\Upload\Contract\FileUploaderInterface;


class LocalFileUploader implements FileUploaderInterface
{

    public function __construct()
    {
        dump("Upload file from local disk");
    }

    public function upload($file)
    {
         dump("Upload file from local disk");
    }

    public function delete($file)
    {
        // TODO: Implement delete() method.
    }
}