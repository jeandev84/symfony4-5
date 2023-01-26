<?php
namespace App\Listeners;

/* use Doctrine\Common\Persistence\Event\LifecycleEventArgs; */

use App\Entity\Video;
use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Twig\Environment;


/**
 *
*/
class NewVideoListener
{

    /**
     * @var Environment
    */
    private $templating;



    private $mailer;




    /**
     * @param Environment $templating
     * @param \Swift_Mailer $mailer
    */
    public function __construct(Environment $templating, \Swift_Mailer $mailer)
    {
         $this->templating = $templating;
         $this->mailer     = $mailer;
    }



    /**
     * Send email all users after creating Video
     *
     * @param LifecycleEventArgs $args
     * @return void
    */
    public function postPersist(LifecycleEventArgs $args)
    {

        $entity = $args->getObject();

        // only act on some "Video" entity
        if (!$entity instanceof Video) {
            return;
        }

        $entityManager = $args->getObjectManager();
        // ... do something with the Product

        $users = $entityManager->getRepository(User::class)->findAll();

        foreach ($users as $user) {
             $message = (new \Swift_Message('Hello Email'))
                        ->setFrom('send@example.com')
                        ->setTo($user->getEmail())
                        ->setBody($this->templating->render('emails/new_video.html.twig', [
                           'name'  => $user->getName(),
                           'video' => $entity
                        ]), 'text/html');

             $this->mailer->send($message);
        }
    }
}