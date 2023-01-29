<?php
namespace App\Service\Upload\Contract;

interface FileUploaderInterface
{
     public function upload($file);

     public function delete($file);
}