<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PostController extends AbstractController
{


      /**
       * @Route("/posts", name="posts")
      */
      public function index(): Response
      {
           return $this->render('post/list.html.twig');
      }


     public function mostPopularPosts(int $number = 3)
     {
         $posts = ['post 1', 'post 2', 'post 3', 'post 4', 'post 5', 'post 6'];

         return $this->render('post/embed/most_popular_posts.html.twig', compact('posts'));
     }
}