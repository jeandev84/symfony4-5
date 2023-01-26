<?php
namespace App\Controller;

use App\Entity\User;
use App\Manager\UserManager;
use App\Service\GiftsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/api/v1/users", name="api.v1.users.")
*/
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
     * @Route("", name="list")
    */
    public function index(GiftsService $giftsService, Request $request): Response
    {
        $users = $this->userManager->findAllUsers();

        // http://localhost:8000/users?page=10
        // exit($request->query->get('page', 'default'));
        // exit($request->request->get('username', ''));
        // exit($request->server->get('HTTP_HOST'));


        if ($request->isXmlHttpRequest()) { // is it an Ajax request ?
             // do something
        }


        $uploadedFile = $request->files->get('photo');


        return $this->render('user/index.html.twig', [
            'users' => $users,
            'random_gifts' => $giftsService->randomizedGifts()
        ]);
    }




    /**
     * @Route("/create", name="create", methods={"POST"})
    */
    public function createUsers(Request $request): Response
    {
        $this->userManager->createUser($request->request->all());

        return new JsonResponse(['success' => 'Users successfully created!']);
    }




    /**
     * @Route("/users/{id}", name="show")
    */
    public function showUser(int $id): JsonResponse
    {
        if (! $user = $this->userManager->findOneUserById(23)) {
            $this->createNotFoundException('The users does not exist');
        }

        return new JsonResponse(compact('user'));
    }





    /**
     * @Route("/fake-users", name="fake-users")
    */
    public function createFakeUsers(): Response
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
