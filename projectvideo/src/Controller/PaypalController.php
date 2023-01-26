<?php
namespace App\Controller;

use App\Controller\Traits\SaveSubscription;
use App\Entity\User;
use App\Utils\Payment\PaypalIPN;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Subscription;


class PaypalController extends AbstractController
{

       use SaveSubscription;


       /**
        * Route("/payment-verify", name="payment_verify", methods={"POST"})
       */
       public function paypalVerify(PaypalIPN $paypalIPN)
       {
             $paypalIPN->useSandbox();
             $paypalIPN->usePHPCerts();


             if ($paypalIPN->verifyIPN()) {

                  if (isset($_POST["payment_status"]) && $_POST["payment_status"] == "Completed") {

                      $planName = $_POST["item_name"];

                      /** @var User $user */
                      $user = $this->getDoctrine()
                                   ->getRepository(User::class)
                                   ->findOneBy(['email' => $_POST["payer_email"]]);

                      if ($user) { $this->saveSubscription($planName, $user); }

                  } elseif ($_POST["txn_type"] == "subscr_cancel" || $_POST["txn_type"] == "subscr_eot") {

                       /** @var User $user */
                       $user = $this->getDoctrine()
                                    ->getRepository(User::class)
                                    ->findOneBy(['email' => $_POST["payer_email"]]);

                       if (!$user) return;


                       $subscription = $user->getSubscription();
                       $subscription->setPlan('canceled');
                       $subscription->setValidTo(new \DateTime());
                       $subscription->setPaymentStatus(null);


                       $em = $this->getDoctrine()->getManager();
                       $em->flush();

                  }
             }


             return new Response();
       }
}