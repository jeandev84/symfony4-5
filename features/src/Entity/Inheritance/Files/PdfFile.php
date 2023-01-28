<?php
namespace App\Entity\Inheritance\Files;

use App\Entity\Inheritance\File;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Inheritance\Files\PdfFileRepository;



/**
 * @ORM\Entity(repositoryClass=PdfFileRepository::class)
 */
class PdfFile extends File
{

    /**
     * @ORM\Column(type="integer")
    */
    private $pages_number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $orientation;


    public function getPagesNumber(): ?int
    {
        return $this->pages_number;
    }

    public function setPagesNumber(int $pages_number): self
    {
        $this->pages_number = $pages_number;

        return $this;
    }

    public function getOrientation(): ?string
    {
        return $this->orientation;
    }

    public function setOrientation(string $orientation): self
    {
        $this->orientation = $orientation;

        return $this;
    }
}
