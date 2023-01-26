<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
    */
    protected $passwordEncoder;


    /**
      * @param UserPasswordEncoderInterface $passwordEncoder
    */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
         $this->passwordEncoder = $passwordEncoder;
    }




    public function load(ObjectManager $manager): void
    {

        foreach ($this->getUserData() as [$name, $lastName, $email, $password, $apiKey, $roles]) {

               $user = new User();
               $user->setName($name);
               $user->setLastName($lastName);
               $user->setEmail($email);
               $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
               $user->setVimeoApiKey($apiKey);
               $user->setRoles($roles);

               $manager->persist($user);
        }

        $manager->flush();
    }



    public function getUserData(): array
    {
        return [
            ['John', 'Wayne', 'jw@symf4.loc', 'passw', 'cc9a2765b47db427efdb5f708e52f08d', ['ROLE_ADMIN']],
            ['John', 'Wayne2', 'jw2@symf4.loc', 'passw', null, ['ROLE_ADMIN']],
            ['John', 'Doe', 'jd@symf4.loc', 'passw', null, ['ROLE_USER']],
            ['Ted', 'Bundy', 'tb@symf4.loc', 'passw', null, ['ROLE_USER']]
        ];
    }
}
