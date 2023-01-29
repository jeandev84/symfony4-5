<?php
namespace App\Service\Upload;

use App\Service\Upload\Contract\FileUploaderInterface;

class S3FileUploader implements FileUploaderInterface
{

    public function __construct()
    {
        dump("Upload file to S3");
    }

    public function upload($file)
    {
        dump("Upload file to S3");
    }

    public function delete($file)
    {
        // TODO: Implement delete() method.
    }
}