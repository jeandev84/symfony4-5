<?php
namespace App\Controller\Traits;

use App\Entity\Subscription;
use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

trait SaveSubscription
{

      /**
       * @param $plan
       * @param User|UserInterface $user
       * @return void
     */
     public function saveSubscription($plan, $user)
     {
           $date = new \DateTime();
           $date->modify('+1 month');
           $subscription = $user->getSubscription();

           if (null === $subscription) {
                $subscription = new Subscription();
           }

           // If Used has free plan
           if ($subscription->getFreePlanUsed() && $plan == Subscription::getPlanDataNameByIndex(0)) {
                return;
           }


           $subscription->setValidTo($date);
           $subscription->setPlan($plan);


           if ($plan == Subscription::getPlanDataNameByIndex(0)) { // free plan
                $subscription->setFreePlanUsed(true);
                $subscription->setPaymentStatus('paid');
           }


           $subscription->setPaymentStatus('paid'); // set temporary paid


           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($user);
           $entityManager->flush();
     }
}