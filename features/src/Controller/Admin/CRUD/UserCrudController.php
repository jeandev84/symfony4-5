<?php
namespace App\Controller\Admin\CRUD;

use App\Entity\User;
use App\Manager\UserManager;
use App\Manager\VideoManager;
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


      /**
       * @var VideoManager
      */
      protected $videoManager;





      /**
       * @param UserManager $userManager
       * @param VideoManager $videoManager
      */
      public function __construct(UserManager $userManager, VideoManager $videoManager)
      {
           $this->userManager = $userManager;
           $this->videoManager = $videoManager;
      }



      /**
       * @Route("/admin/users", name="admin.users.list", methods={"GET"})
      */
      public function list(): Response
      {
          return $this->render('admin/user/list.html.twig', [
              'users' => $this->userManager->getUsers()
          ]);
      }





     /**
      * @Route("/admin/users/{id}", name="admin.users.show", methods={"GET"}, requirements={"id": "\d+"})
     */
     public function show(int $id, User $user): Response
     {
         /*
         $robert = $this->userManager->findOneUserBy(['name' => 'Robert', 'id' => $id]);   // dump($robert);
         $users  = $this->userManager->findUsersBy(['name' => 'Robert'], ['id' => 'DESC']); // dump($users);
         */


         dump($user);

         return $this->render('admin/user/show.html.twig', [
            'user' => $this->userManager->findUserById($id)
         ]);
      }




      /**
       * @Route("/admin/users/create", name="admin.users.create", methods={"GET"})
      */
      public function create(): Response
      {
          return $this->render('admin/user/create.html.twig');
      }





     /**
      * @Route("/admin/users/store", name="admin.users.store", methods={"POST"})
     */
     public function store(Request $request): Response
     {
         $user = $this->userManager->createUser($request->request->all());

         return new JsonResponse(['success' => "A new user was saved with id of {$user->getId()}"], Response::HTTP_CREATED);
     }




    /**
     * @Route("/admin/users/{id}/edit", name="admin.users.edit", methods={"GET"}, requirements={"id": "\d+"})
    */
    public function edit(User $user): Response
    {
        return $this->render('admin/user/edit.html.twig', [
             'user' => $user
        ]);
    }




     /**
      * @Route("/admin/users/{id}", name="admin.users.update", methods={"PUT"}, requirements={"id": "\d+"})
     */
     public function update(Request $request, $id): JsonResponse
     {
          if (! $user = $this->userManager->updateUserById($id, $request->request->all())) {
              dump("user {$user->getId()} was updated");
          }

         return new JsonResponse(['success' => "User with id {$id} updated!"], Response::HTTP_OK);
     }




    /**
     * @Route("/admin/users/{id}", name="admin.users.delete", methods={"DELETE"}, requirements={"id": "\d+"})
     */
    public function delete($id): JsonResponse
    {
        if ($this->userManager->deleteUserById($id)) {
            dump("User with id {$id} deleted");
        }

        return new JsonResponse(['success' => "User with id {$id} deleted"], Response::HTTP_NO_CONTENT);
    }





    /**
     * @Route("/admin/users/{id}/remove-video/{video}", name="admin.users.remove.video", methods={"DELETE"}, requirements={"id": "\d+", "video": "\d+"})
    */
    public function removeVideo(int $id, int $video): JsonResponse
    {
        if (! $video = $this->videoManager->findVideo($video)) {
            return new JsonResponse(['success' => "Video with id {$id} does not exist"], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = $this->userManager->removeUserVideo($id, $video);


        foreach ($user->getVideos() as $video) {
             dump($video->getTitle());
        }

        return new JsonResponse(['success' => "User with id {$id} deleted"], Response::HTTP_NO_CONTENT);
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