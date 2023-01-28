<?php
namespace App\Service\Builder;

use App\Entity\User;
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

    public function __construct(VideoManager $videoManager, UserManager $userManager)
    {
        $this->videoManager = $videoManager;
        $this->userManager  = $userManager;
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
}