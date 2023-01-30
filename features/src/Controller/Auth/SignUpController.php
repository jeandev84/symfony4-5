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


class SignUpController extends AbstractController
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
      * @Route("/auth/user/register", name="auth.user.register")
     */
     public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
     {

           # Registration
           $user = new SecurityUser();
           $form = $this->createForm(UserRegistrationFormType::class, $user);
           $form->handleRequest($request);

           if ($form->isSubmitted() && $form->isValid()) {

               $user->setPassword($passwordEncoder->encodePassword($user, $form->get('password')->getData()));
               $user->setEmail($form->get('email')->getData());
               $this->entityManager->persist($user);
               $this->entityManager->flush();

               return $this->redirectToRoute('home');
           }



           return $this->render('auth/user/register.html.twig', [
               'form' => $form->createView()
           ]);
     }
}