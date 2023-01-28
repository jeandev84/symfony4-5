<?php
namespace App\Controller\Admin\CRUD;

use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserCrudController extends AbstractController
{

       /**
        * @var UserManager
      */
      protected $userManager;

      public function __construct(UserManager $userManager)
      {
           $this->userManager = $userManager;
      }



      /**
       * @Route("/admin/users", name="admin.users.list")
      */
      public function list(): Response
      {
          return $this->render('admin/crud/user/list.html.twig', [
              'users' => $this->userManager->getUsers()
          ]);
      }




      /**
       * @Route("/admin/users/create", name="admin.users.create", methods={"POST"})
      */
      public function create(): Response
      {
          if($user = $this->userManager->createUser(['name' => 'Robert'])) {
              dump('A new user was saved with id of '. $user->getId());
          }

          return $this->render('admin/crud/user/create.html.twig');
      }
}