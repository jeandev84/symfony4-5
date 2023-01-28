<?php
namespace App\Controller\Admin\CRUD;

use App\Manager\UserManager;
use Doctrine\DBAL\Driver\Statement;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
       * @Route("/admin/users", name="admin.users.list", methods={"GET"})
      */
      public function list(): Response
      {
          return $this->render('admin/crud/user/list.html.twig', [
              'users' => $this->userManager->getUsers()
          ]);
      }





     /**
      * @Route("/admin/users/{id}", name="admin.users.show", methods={"GET"}, requirements={"id": "\d+"})
     */
     public function show(int $id): Response
     {
         $robert = $this->userManager->findOneUserBy(['name' => 'Robert', 'id' => $id]);   // dump($robert);
         $users  = $this->userManager->findUsersBy(['name' => 'Robert'], ['id' => 'DESC']); // dump($users);


         return $this->render('admin/crud/user/show.html.twig', [
            'user' => $this->userManager->findUserById($id)
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

          return $this->render('admin/crud/user/form/create.html.twig');
      }



     /**
      * @Route("/admin/users/{id}", name="admin.users.update", methods={"PUT"})
     */
     public function update(Request $request, $id): Response
     {
          if ($user = $this->userManager->updateUser($id, $request->request->all())) {
              dump("user {$user->getId()} was updated");
          }

          return $this->render('admin/crud/user/form/edit.html.twig');
     }




    /**
     * @Route("/admin/users/{id}", name="admin.users.delete", methods={"DELETE"})
     */
    public function delete($id): Response
    {
        if ($this->userManager->deleteUser($id)) {
            dump("User with id {$id} deleted");
        }

        return new JsonResponse(['success' => "User with id {$id} deleted"]);
    }



    /**
     * @param EntityManagerInterface $entityManager
     * @return mixed
     * @throws Exception
    */
    public function rawQueries(EntityManagerInterface $entityManager)
    {
         $conn = $entityManager->getConnection();

         $sql = ' SELECT * FROM user u  WHERE u.id > :id';

         /** @var  Statement $statement */
         $statement = $conn->prepare($sql);
         $statement->executeQuery(['id' => 3]);

         return $users = $statement->fetchAll();
    }
}