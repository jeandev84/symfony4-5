<?php
namespace App\Manager;

use App\Entity\User;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

class UserManager
{

    /**
     * @var EntityManagerInterface
    */
    protected $entityManager;


    public function __construct(EntityManagerInterface  $entityManager)
    {
         $this->entityManager = $entityManager;
    }



    public function saveUser(User $user): User
    {
         $this->entityManager->persist($user);
         $this->entityManager->flush();

         return $user;
    }



    public function createUser(array $payload): User
    {
          $user = new User();
          $user->setName($payload['name']);

          return $this->saveUser($user);
    }





    public function updateUserById(int $userId, array $payload)
    {
         if(!$user = $this->findUserById($userId)) {
              return false;
         }

         $user->setName($payload['name']);

         return $this->saveUser($user);
    }



    public function createFakeUsers(array $users)
    {
          foreach ($users as $payload) {

              $user = new User();
              $user->setName($payload['name']);
              $this->entityManager->persist($user);
          }

          $this->entityManager->flush();
    }


    /**
     * @param User $user
     * @return bool
    */
    public function deleteUser(User $user): bool
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return true;
    }


    /**
     * @param int $userId
     * @return bool
    */
    public function deleteUserById(int $userId): bool
    {
        if(!$user = $this->findUserById($userId)) {
            return false;
        }

        return $this->deleteUser($user);
    }


    /**
     * @return User[]
    */
    public function getUsers(): array
    {
         $repository = $this->entityManager->getRepository(User::class);

         return $repository->findAll();
    }



    public function getOneUserById(int $userId)
    {
        $repository = $this->entityManager->getRepository(User::class);

        return $repository->findOneBy(['id' => $userId]);
    }





    /**
     * @param int $userId
     * @return Collection
    */
    public function getUserVideos(int $userId): Collection
    {
         return $this->findUserById($userId)->getVideos();
    }


    /**
     * @param int $userId
     * @return User|null
    */
    public function findUserById(int $userId): ?User
    {
        $repository = $this->entityManager->getRepository(User::class);

        return $repository->find($userId);
    }


    /**
     * @param array $criteria
     * @return User|null
    */
    public function findOneUserBy(array $criteria): ?User
    {
        $repository = $this->entityManager->getRepository(User::class);

        return $repository->findOneBy($criteria);
    }


    /**
     * @param array $criteria [WHERE Conditions]
     * @param array $orderBy [Sorting Extraction]
     * @param $limit [Max Results]
     * @param $offset [First Result]
     * @return User[]
    */
    public function findUsersBy(array $criteria, array $orderBy = [], $limit = null, $offset = null): array
    {
        $repository = $this->entityManager->getRepository(User::class);

        return $repository->findBy($criteria, $orderBy, $limit, $offset);
    }
}