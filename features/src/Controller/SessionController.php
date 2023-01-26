<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class SessionController extends AbstractController
{


      /**
       * @var SessionInterface
      */
      protected $session;


      /**
       * @param SessionInterface $session
      */
      public function __construct(SessionInterface $session)
      {
           $this->session = $session;
      }



      /**
       * @Route("/add-to-cart", name="add.to.cart")
      */
      public function addToSession()
      {
           $this->session->set('cart', [
              'product_id' => 1,
              'quantity'   => 3
           ]);

           if ($this->session->has('cart')) {
                dd($this->session->get('cart'));
           }
      }




    /**
     * @Route("/remove-from-cart", name="remove.from.cart")
    */
    public function removeFromSession()
    {
         $this->session->remove('cart');
    }




    /**
     * @return void
    */
    public function clearSession()
    {
         $this->session->clear();
    }
}