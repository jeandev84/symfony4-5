<?php
namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


trait HasTimestamp
{

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Type("\Datetime")
    */
    private $createdAt;



    /**
     * @ORM\Column(type="datetime", nullable=true)
    */
    private $updatedAt;



    /**
     * @ORM\Column(type="datetime", nullable=true)
    */
    private $deletedAt;




    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }



    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }



    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }



    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}