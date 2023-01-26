<?php

namespace App\Tests\Controllers\Front;

use App\Entity\Subscription;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FrontControllerSubscriptionTest extends WebTestCase
{
     use App\Tests\RoleUser;;


     /**
      * @dataProvider urlsWithVideo
     */
     public function testLoggedInUserDoesNotSeeTextForNoMembers($url)
     {
          $this->client->request('GET', $url);

          $this->assertNotSame('Video for <b>MEMBERS</b> only.', $this->client->getResponse()->getContent());
     }





      /**
       * @dataProvider urlsWithVideo
      */
      public function testNotLoggedInUserSeesTextForNoMembers($url)
      {
           $client = static::createClient();
           $client->request('GET', $url);
//           $this->assertContains('Video for <b>MEMBERS</b> only.', $client->getResponse()->getContent());
           $this->assertSame('Video for <b>MEMBERS</b> only.', $client->getResponse()->getContent());
      }




       public function urlsWithVideo()
       {
            yield['/video-list/category/movies,4'];
            yield['/search-results?query=movies'];
       }



       /**
        * @dataProvider urlsWithVideo
       */
       public function testExpiredSubscription()
       {
            $subscription = $this->entityManager->getRepository(Subscription::class)
                                                ->find(2);

            $invalidDate = new \DateTime();
            $invalidDate->modify('-1 day');
            $subscription->setValidTo($invalidDate);

            $this->entityManager->persist($subscription);
            $this->entityManager->flush();

            $this->client->request('GET', '/video-list/category/movies,4');

            $this->assertContains('Videos for <b>MEMBERS</b> only.',
              $this->client->getResponse()->getContent()
            );
       }





       /**
        * @dataProvider urlsWithVideo2
       */
       public function testNotLoggedInUserSeesVideosForNoMembers($url)
       {
             $client = static::createClient();
             $client->request('GET', $url);
             $this->assertContains('https://player.vimeo.com/video/113716040', $client->getResponse()->getContent());
       }




      public function urlsWithVideo2()
      {
          yield['/video-list/category/toys,2/2'];
          yield['/search-results?query=Movies+3'];
          yield['/video-details/2#video_comments'];
      }
}
