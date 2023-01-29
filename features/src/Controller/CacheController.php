<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Cache\Adapter\TagAwareAdapter;
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






      /**
       * @Route("/cache-tags", name="cache.tags")
      */
      public function cacheTags()
      {
          // USING FOR MORE ADVANCED CACHING SYSTEM
          $cache = new TagAwareAdapter(
              new FilesystemAdapter()
          );


          $acer   = $cache->getItem('acer');
          $dell   = $cache->getItem('dell');
          $ibm    = $cache->getItem('ibm');
          $apple  = $cache->getItem('apple');


          if (! $acer->isHit()) {
               $acer_from_db = 'acer laptop';
               $acer->set($acer_from_db);
               $acer->tag(['computers', 'laptops', 'acer']);
               $cache->save($acer);

               dump('acer laptop from database ...');
          }



          if (! $dell->isHit()) {
              $dell_from_db = 'dell laptop';
              $dell->set($dell_from_db);
              $dell->tag(['computers', 'laptops', 'dell']);
              $cache->save($dell);

              dump('dell laptop from database ...');
          }



          if (! $ibm->isHit()) {
              $ibm_from_db = 'ibm desktop';
              $ibm->set($ibm_from_db);
              $ibm->tag(['computers', 'desktops', 'ibm']);
              $cache->save($ibm);

              dump('ibm desktop from database ...');
          }



          if (! $apple->isHit()) {
              $apple_from_db = 'apple desktop';
              $apple->set($apple_from_db);
              $apple->tag(['computers', 'desktops', 'apple']);
              $cache->save($apple);

              dump('apple desktop from database ...');
          }


          // $cache->invalidateTags(['ibm']); remove tag ibm from the cache
          // $cache->invalidateTags(['desktops']);
          // $cache->invalidateTags(['laptops']);
          $cache->invalidateTags(['computers']);

          $cacheItems = [$acer->get(), $dell->get(), $ibm->get(), $apple->get()];


          dd($cacheItems);
      }
}