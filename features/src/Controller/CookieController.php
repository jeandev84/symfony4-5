<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CookieController
{

     /**
      * @Route("/send-cookie", name="send.cookie")
     */
     public function sendCookieToTheBrowser(): Response
     {
         $expireAfter = time() + (2 * 365 * 24 * 60 * 60); // // Expires after 2 years
         $cookie = new Cookie('cookieName', 'cookieValue', $expireAfter);

         $response = new Response();
         $response->headers->setCookie($cookie);
         $response->send();

         return $response;
     }




    /**
     * @Route("/clear-cookie", name="clear.cookie")
     */
    public function clearCookieFromTheBrowser(): Response
    {
        $response = new Response();
        $response->headers->clearCookie('cookieName');
        $response->send();

        return $response;
    }
}