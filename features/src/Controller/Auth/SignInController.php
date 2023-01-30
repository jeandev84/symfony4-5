<?php
namespace App\Controller\Auth;

use App\Entity\SecurityUser;
use App\Form\UserRegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SignInController extends AbstractController
{


     /**
      * @Route("/auth/user/login", name="auth.user.login")
     */
     public function login(AuthenticationUtils $authenticationUtils): Response
     {

           $error = $authenticationUtils->getLastAuthenticationError();
           $lastUsername = $authenticationUtils->getLastUsername();

           return $this->render('auth/user/login.html.twig', [
              'last_username' => $lastUsername,
              'error' => $error
           ]);
     }
}