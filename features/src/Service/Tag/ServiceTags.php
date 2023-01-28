<?php
namespace App\Service\Tag;

use Doctrine\ORM\Event\PostFlushEventArgs;


class ServiceTags
{
     public function __construct()
     {
         // dump(__CLASS__);
     }



     public function postFlush(PostFlushEventArgs $args)
     {
         dump('Do something when we will be flush entity');
         dump($args);
     }



     public function clear()
     {
          dump('Do something before clear cache');
     }
}