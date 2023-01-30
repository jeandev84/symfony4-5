<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class EmailSenderController extends AbstractController
{

      protected $mailer;


      public function __construct(\Swift_Mailer $mailer)
      {
          $this->mailer = $mailer;
      }



      /**
       * @Route("/send-email", name="send.email")
      */
      public function sendEmail(): Response
      {
            $message = (new \Swift_Message('Hello Email'))
                      ->setFrom('send@example.com')
                      ->setTo('recipient@example.com')
                      ->setBody($this->renderView('emails/registration.html.twig', [
                          'name' => 'Robert'
                      ]), 'text/html');

            $this->mailer->send($message);

            return $this->render('page/contact-us.html.twig');
      }
}