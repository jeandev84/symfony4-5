<?php
namespace App\Entity;

use App\Entity\Traits\HasTimestamp;
use App\Repository\VideoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=VideoRepository::class)
 * @ORM\HasLifecycleCallbacks()
*/
class Video
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
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=2,
     *     max=10,
     *     minMessage="Video title must be at least {{ limit }} characters long",
     *     maxMessage="Video title cannot be longer than {{ limit }} characters"
     * )
    */
    private $title;



    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="videos")
     * @ORM\JoinColumn(nullable=true)
    */
    private $user;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


    /**
     * @ORM\PrePersist
    */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();

        //dump($this->createdAt);
    }
}
