<?php
namespace App\Controller;

use App\Entity\User;
use App\Manager\UserManager;
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
     * @param UserManager $userManager
    */
    public function __construct(UserManager  $userManager)
    {
        $this->userManager = $userManager;
    }



    /**
     * @Route("/users", name="users")
    */
    public function index(): Response
    {
        $users = $this->userManager->findAllUsers();

        return $this->render('user/index.html.twig', [
            'users' => $users
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
