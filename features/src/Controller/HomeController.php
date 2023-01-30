<?php
namespace App\Controller;

use App\Entity\SecurityUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


     /**
      * @var EntityManagerInterface
     */
     protected $entityManager;


     /**
      * @param EntityManagerInterface $entityManager
     */
     public function __construct(EntityManagerInterface $entityManager)
     {
         $this->entityManager = $entityManager;
     }




    /**
     * @Route("/", name="home")
    */
    public function index(): Response
    {
        # Users List
        $users = $this->entityManager->getRepository(SecurityUser::class)->findAll();
        dump($users);

        return $this->render('home/index.html.twig');
    }
}
