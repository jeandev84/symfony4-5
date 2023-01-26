<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class BlogController extends AbstractController
{


     /**
      * @Route("/blog/{page?}", name="blog_list", requirements={"page"="\d+"})
     */
     public function showPageWithOptionalParameter(int $page = null): Response
     {
          // http://localhost:8000/blog
          // http://localhost:8000/blog/3
          return new Response("Optional parameters in url and requirements for parameters");
     }


     /**
      * @Route(
      *   "/articles/{_locale}/{year}/{slug}/{category}",
      *   defaults={"category": "computers"},
      *   requirements={
      *      "_locale": "en|fr",
      *      "category": "computers|rtv",
      *      "year": "\d+"
      *   }
      * )
     */
     public function listArticlesByCategory(): Response
     {
         // http://localhost:8000/articles/en/2019/dell [ because defined default parameter "category" ]
         // http://localhost:8000/articles/en/2019/dell/computers
         // http://localhost:8000/articles/fr/2019/dell/computers
         // http://localhost:8000/articles/fr/2019/dell/rtv

         return new Response("An advanced route example");
     }




    /**
     * @Route({
     *   "nl": "/over-ons",
     *   "en": "/about-us",
     *   "ru": "/o-nas",
     *   "fr": "/a-propos"
     * }, name="about_us")
     */
     public function generateRoutePathInDifferentLanguages(): Response
     {
           // http://localhost:8000/about-us
           // http://localhost:8000/a-propos
           return new Response("Translated routes.");
     }
}