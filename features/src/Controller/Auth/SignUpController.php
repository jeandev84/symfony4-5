<?php
namespace App\Controller\Auth;

use App\Entity\SecurityUser;
use App\Form\UserRegistrationFormType;
use App\Manager\SecurityUserManager;
use App\Manager\UserManager;
use App\Manager\VideoManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SignUpController extends AbstractController
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
       * @var EntityManagerInterface
      */
      protected $entityManager;




      /**
       * @var UserPasswordEncoderInterface
      */
      protected $passwordEncoder;


      /**
       * @param SecurityUserManager $userManager
       * @param VideoManager $videoManager
       * @param EntityManagerInterface $entityManager
       * @param UserPasswordEncoderInterface $passwordEncoder
      */
      public function __construct(
          SecurityUserManager $userManager,
          VideoManager $videoManager,
          EntityManagerInterface $entityManager,
          UserPasswordEncoderInterface $passwordEncoder
      )
      {
           $this->userManager = $userManager;
           $this->videoManager = $videoManager;
           $this->entityManager = $entityManager;
           $this->passwordEncoder = $passwordEncoder;
      }




     /**
      * @Route("/auth/user/register", name="auth.user.register")
     */
     public function register(Request $request)
     {

           # Registration
           $user = new SecurityUser();
           $form = $this->createForm(UserRegistrationFormType::class, $user);
           $form->handleRequest($request);

           if ($form->isSubmitted() && $form->isValid()) {

               /*
               $user->setPassword($this->passwordEncoder->encodePassword($user, $form->get('password')->getData()));
               $user->setEmail($form->get('email')->getData());
               $this->entityManager->persist($user);
               $this->entityManager->flush();
               */

               $this->userManager->saveUser($user, [
                   'email'    => $form->get('email')->getData(),
                   'password' => $form->get('password')->getData()
               ]);


               return $this->redirectToRoute('home');
           }



           return $this->render('auth/user/register.html.twig', [
               'form' => $form->createView()
           ]);
     }







     /**
       * @Route("/auth/user/create", name="auth.user.create")
     */
     public function createSimpleUser(UserPasswordEncoderInterface $passwordEncoder)
     {

           /*
           $user = new SecurityUser();
           $user->setEmail('user@demo.com');
           $password = $passwordEncoder->encodePassword($user, 'passw');
           $user->setPassword($password);

           $this->entityManager->persist($user);
           $this->entityManager->flush();

           dd($user->getId());
           */

           $user = $this->userManager->createUser([
              'email'    => 'user@demo.com',
              'password' => 'passw'
           ]);

           dd($user->getId());
     }




    /**
     * @Route("/auth/admin/create", name="auth.admin.create")
    */
    public function createUserAdmin()
    {
        $user = $this->userManager->createUserAdmin([
            'email'    => 'admin@demo.com',
            'password' => 'passw'
        ]);

        $video = $this->videoManager->createVideo([
            'title' => 'video title',
            'file'  => 'video path'
        ]);

        $user = $this->userManager->addVideoToUser($user, $video);

        dump($user->getId());
        dd($video->getId());
    }

}