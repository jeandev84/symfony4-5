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




    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File(
     *     maxSize="50M",
     *     mimeTypes = {"video/mp4", "application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid video"
     * )
    */
    // maxSize="1024k", "5M"
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity=SecurityUser::class, inversedBy="videos")
     */
    private $securityUser;




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

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getSecurityUser(): ?SecurityUser
    {
        return $this->securityUser;
    }

    public function setSecurityUser(?SecurityUser $securityUser): self
    {
        $this->securityUser = $securityUser;

        return $this;
    }
}
