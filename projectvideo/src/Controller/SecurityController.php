<?php
namespace App\Controller;



use App\Controller\Traits\SaveSubscription;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Subscription;



class SecurityController extends AbstractController
{


    use SaveSubscription;



    /**
     * @Route("/register/{plan}", name="register", defaults={"plan": null})
     */
    public function register(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        SessionInterface $session,
        $plan
    ): Response
    {

        if ($request->isMethod('GET')) {

               // Put plan name in session for use them later during user session
               $session->set('planName', $plan);

               // Put plan price in session
               $session->set('planPrice', Subscription::getPlanDataPriceByName($plan));
        }


        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            $user->setName($request->request->get('user')['name']);
            $user->setLastName($request->request->get('user')['last_name']);
            $user->setEmail($request->request->get('user')['email']);

            $encodedPassword = $encoder->encodePassword($user, $request->request->get('user')['password']['first']);

            $user->setPassword($encodedPassword);

            $user->setRoles(['ROLE_USER']);


            // Subscription
            $date = new \DateTime();
            $date->modify('+1 month');

            $subscription = new Subscription();
            $subscription->setValidTo($date);
            $subscription->setPlan($session->get('planName'));

            // If user checked a free plan
            if ($plan == Subscription::getPlanDataNameByIndex(0)) {
                 $subscription->setFreePlanUsed(true);
                 $subscription->setPaymentStatus('paid');
            }


            $user->setSubscription($subscription);


            // Save to the database
            $entityManager->persist($user);
            $entityManager->flush();

            $this->loginUserAutomatically($user, $encodedPassword);

            return $this->redirectToRoute('admin_main_page');
        }


        // If user is logged in and plan is free
        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED') && $plan == Subscription::getPlanDataNameByIndex(0)) { // free plan

             //to do save subscription
             $this->saveSubscription($plan, $this->getUser());

             // redirect to the admin page
             return $this->redirectToRoute('admin_main_page');

        } elseif($this->isGranted('IS_AUTHENTICATED_REMEMBERED')) { // If user only logged in

            return $this->redirectToRoute('payment');
        }

        return $this->render('front/register.html.twig', [
            'form' => $form->createView()
        ]);
    }





    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $helper): Response
    {
        return $this->render('front/login.html.twig', [
            'error' => $helper->getLastAuthenticationError()
        ]);
    }




    /**
     * @param UserInterface $user
     * @param $password
     * @return void
     */
    private function loginUserAutomatically(UserInterface $user, $password)
    {
        $token = new UsernamePasswordToken(
            $user,
            $password,
            'main', // firewall name
            $user->getRoles()
        );

        $this->get('security.token_storage')->setToken($token);
        $this->get('session')->set('security_main', serialize($token));
    }



    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        throw new \Exception('This should never be reached!');
    }


}