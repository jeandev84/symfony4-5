<?php
namespace App\Service\Builder;

use App\Entity\User;
use App\Manager\AddressManager;
use App\Manager\UserManager;
use App\Manager\VideoManager;

class UserBuilderService
{

    /**
     * @var VideoManager
     */
    protected $videoManager;


    /**
     * @var UserManager
    */
    protected $userManager;



    /**
     * @var AddressManager
    */
    protected $addressManager;


    /**
     * @param VideoManager $videoManager
     * @param UserManager $userManager
     * @param AddressManager $addressManager
    */
    public function __construct(
        VideoManager $videoManager,
        UserManager $userManager,
        AddressManager $addressManager
    )
    {
        $this->videoManager = $videoManager;
        $this->userManager  = $userManager;
        $this->addressManager = $addressManager;
    }



    /**
     * @param User $user
     * @param array $videos
     * @return User
    */
    public function addUserVideos(User $user, array $videos): User
    {
          foreach ($videos as $video) {
               $user->addVideo($this->videoManager->createVideo($video));
          }

          return $user;
    }


    /**
     * @param User $user
     * @param array $address
     * @return User
    */
    public function setUserAddress(User $user, array $address): User
    {
         $address = $this->addressManager->createAddress($address);
         $user->setAddress($address);

         return $user;
    }
}