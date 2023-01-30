<?php
namespace App\Manager;

use App\Entity\SecurityUser;
use App\Entity\User;
use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;



class VideoManager
{

    /**
     * @var EntityManagerInterface
    */
    protected $entityManager;




    /**
     * @param EntityManagerInterface $entityManager
    */
    public function __construct(EntityManagerInterface  $entityManager)
    {
        $this->entityManager = $entityManager;
    }




    /**
     * @param Video $video
     * @return Video
    */
    public function saveVideo(Video $video): Video
    {
         $this->entityManager->persist($video);
         $this->entityManager->flush();

         return $video;
    }




    /**
     * @param Video $video
     * @param array $payload
     * @return Video
    */
    public function updateVideo(Video $video, array $payload): Video
    {
        $video->setTitle($payload['title']);
        $video->setFile($payload['file']);
        $video->setUpdatedAt(new \DateTime());
        $this->saveVideo($video);

        return $video;
    }




    /**
     * @param array $payload
     * @return Video
    */
    public function createVideo(array $payload): Video
    {
         $video = new Video();
         $video->setTitle($payload['title']);
         $video->setFile($payload['file']);
         $video->setCreatedAt(new \DateTime());
         $this->saveVideo($video);

         return $video;
    }


    /**
     * @param Video $video
     * @param SecurityUser $user
     * @return Video
    */
    public function addSecurityUserVideo(Video $video, SecurityUser $user): Video
    {
         $video->setSecurityUser($user);

         $this->entityManager->persist($video);
         $this->entityManager->flush();

         return $video;
    }


    /**
     * @return Video[]
    */
    public function getVideos(): array
    {
         $repository = $this->entityManager->getRepository(Video::class);

         return $repository->findAll();
    }


    /**
     * @param int $id
     * @return Video|null
    */
    public function getVideoById(int $id): ?Video
    {
        $repository = $this->entityManager->getRepository(Video::class);

        /** @var Video $user */
        if(! $video = $repository->findOneBy(['id' => $id])) {
             return null;
        }

        return $video;
    }


    /**
     * @param int $id
     * @return Video
    */
    public function findVideo(int $id): ?Video
    {
        $repository = $this->entityManager->getRepository(Video::class);

        /** @var Video $user */
        if(! $video = $repository->find($id)) {
            return null;
        }

        return $video;
    }



    public function createVideoForm()
    {

    }
}