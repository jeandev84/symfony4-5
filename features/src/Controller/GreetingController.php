<?php
namespace App\Controller;

use App\Entity\User;
use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GreetingController extends AbstractController
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
     * @Route("/greeting", name="greeting")
    */
    public function index(): Response
    {
        return $this->render('greeting/index.html.twig', [
            'username' => 'John'
        ]);
    }
}
