<?php
namespace App\Controller;

use App\Entity\User;
use App\Manager\UserManager;
use App\Service\GiftsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{


    /**
     * @var UserManager
    */
    protected $userManager;



    /**
     * @var GiftsService
    */
    protected $giftsService;


    /**
     * @param UserManager $userManager
     * @param GiftsService $giftsService
    */
    public function __construct(UserManager  $userManager, GiftsService $giftsService)
    {
          $this->userManager  = $userManager;
          $this->giftsService = $giftsService;
    }



    /**
     * @Route("/users", name="users")
    */
    public function index(GiftsService $giftsService): Response
    {
        $users = $this->userManager->findAllUsers();

        return $this->render('user/index.html.twig', [
            'users' => $users,
            'random_gifts' => $giftsService->randomizedGifts()
        ]);
    }




    /**
     * @Route("/create/users", name="create.users")
     */
    public function createUsers(): Response
    {
        $this->userManager->createFakeUsers([
            ['name' => 'Adam'],
            ['name' => 'Robert'],
            ['name' => 'John'],
            ['name' => 'Susan']
        ]);


        return new JsonResponse(['success' => 'Users successfully created!']);
    }
}
