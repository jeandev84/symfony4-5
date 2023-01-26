<?php
namespace App\Utils\Uploader;

use App\Utils\Interfaces\UploaderFileInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class LocalUploader implements UploaderFileInterface
{


    /**
     * @var mixed
    */
    private $targetDirectory;


    /**
     * @var mixed
    */
    public $file;



    public function __construct($targetDirectory)
    {
          $this->targetDirectory = $targetDirectory;
    }



    /**
     * @param UploadedFile $file
     * @return mixed
     * @throws \Exception
    */
    public function upload(UploadedFile $file)
    {
            $videoNumber = random_int(1, 10000000);

            $fileName = $videoNumber . '.'. $file->guessExtension();

            try {

                $file->move($this->getTargetDirectory(), $fileName);

            } catch (FileException $e) {

                 // ... handle exception if something happens during file upload
            }

            $originalFileName = $this->clear(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

            return [$fileName, $originalFileName];
    }



    public function delete($path)
    {
          $filesystem = new Filesystem();

          try {

              $filesystem->remove('.'. $path);

          } catch (IOExceptionInterface $e) {
               echo "An error occurred while deleting your file at". $e->getPath();
          }

          return true;
    }



    /**
     * @return mixed
    */
    private function getTargetDirectory()
    {
        return $this->targetDirectory;
    }




    private function clear($path)
    {
        return preg_replace('/[^A-Za-z0-9- ]+/', '', $path);
    }

}