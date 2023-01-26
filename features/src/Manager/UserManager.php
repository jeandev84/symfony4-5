<?php
namespace App\Manager;

use App\Entity\User;
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



    public function saveUser(User $user)
    {
         $this->entityManager->persist($user);
         $this->entityManager->flush();
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
     * @return User[]
    */
    public function findAllUsers(): array
    {
         $repository = $this->entityManager->getRepository(User::class);

         return $repository->findAll();
    }
}