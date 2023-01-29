<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Routing\Annotation\Route;


class CacheController  extends AbstractController
{



      /**
       * @Route("/cache-posts-items", name="cache.posts.items")
      */
      public function getCachedPosts(AdapterInterface $cache)
      {
            $posts = $cache->getItem('database.get_posts');

            if (! $posts->isHit()) { // if data don't exist in the cache

                 $posts_from_db = ['post 1', 'post 2', 'post 3'];
                 dump('connected with database ...');

                 $posts->set(serialize($posts_from_db));
                 $posts->expiresAfter(5);
                 $cache->save($posts);
            }

            // $cache->deleteItem('database.get_posts');

            $cache->clear();

            dump(unserialize($posts->get()));

            dd('Load cached posts');
      }
}