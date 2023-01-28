<?php
namespace App\Entity\Inheritance\Files;


use App\Entity\Inheritance\File;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Inheritance\Files\VideoFileRepository;



/**
 * @ORM\Entity(repositoryClass=VideoFileRepository::class)
*/
class VideoFile extends File
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $format;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;


    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }
}
