<?php
namespace App\Entity;

use App\Entity\Traits\HasTimestamp;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\HasLifecycleCallbacks()
*/
class User
{

    use HasTimestamp;



    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
    */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
    */
    private $name;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\PrePersist
    */
    public function setCreatedAtValue()
    {
         $this->createdAt = new \DateTime();

         dump($this->createdAt);
    }
}
