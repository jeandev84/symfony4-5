<?php
namespace App\Manager;

use App\Entity\SecurityUser;
use App\Entity\User;
use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityUserManager
{

    /**
     * @var EntityManagerInterface
    */
    protected $entityManager;


    /**
     * @var UserPasswordEncoderInterface
    */
    protected $passwordEncoder;


    /**
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordEncoderInterface $passwordEncoder
    */
    public function __construct(EntityManagerInterface  $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
          $this->entityManager = $entityManager;
          $this->passwordEncoder = $passwordEncoder;
    }


    /**
     * @param SecurityUser $user
     * @param array $payload
     * @return SecurityUser
    */
    public function saveUser(SecurityUser $user, array $payload): SecurityUser
    {
        $user->setEmail($payload['email']);
        $password = $this->passwordEncoder->encodePassword($user, $payload['password']);
        $user->setPassword($password);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }




    /**
     * @param array $payload
     * @return SecurityUser
    */
    public function createUser(array $payload): SecurityUser
    {
        return $this->saveUser(new SecurityUser(), $payload);
    }


    /**
     * @param array $payload
     * @return SecurityUser
    */
    public function createUserAdmin(array $payload): SecurityUser
    {
        $user = new SecurityUser();
        $user->setRoles(['ROLE_ADMIN']);

        return $this->saveUser($user, $payload);
    }


    /**
     * @param SecurityUser $user
     * @param Video $video
     * @return SecurityUser
     */
    public function addVideoToUser(SecurityUser $user, Video $video): SecurityUser
    {
         $user->addVideo($video);

         $this->entityManager->persist($user);
         $this->entityManager->flush();

         return $user;
    }
}