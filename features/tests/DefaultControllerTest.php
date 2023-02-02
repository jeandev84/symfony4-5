<?php
namespace App\Tests;

use App\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DefaultControllerTest extends WebTestCase
{


    private $entityManager;



    protected function setUp(): void
    {
         parent::setUp();

         $this->client = static::createClient();
         $this->entityManager = $this->client->getContainer()->get('doctrine.orm.entity_manager');

         $this->entityManager->beginTransaction();
         $this->entityManager->getConnection()->setAutoCommit(false);
    }



    public function tearDown(): void
    {
         $this->entityManager->rollback();
         $this->entityManager->close();
         $this->entityManager = null;
    }


    /**
     * @dataProvider provideUrls
     * @param $url
     * @return void
    */
    public function testSomething($url): void
    {
         $crawler = $this->client->request('GET', $url);

         $this->assertTrue($this->client->getResponse()->isSuccessful());

         $video = $this->entityManager->getRepository(Video::class)
                                      ->find(1);


         $this->entityManager->remove($video);
         $this->entityManager->flush();


         $this->assertNull($this->entityManager->getRepository(Video::class)->find(1));
    }



//    /**
//     * @dataProvider provideUrls
//     * @param $url
//     * @return void
//    */
//    public function testWithDataProviders($url)
//    {
//        $client = static::createClient();
//        $crawler = $client->request('GET', $url);
//
//        $this->assertTrue($client->getResponse()->isSuccessful());
//    }



    public function provideUrls(): array
    {
         return [
             ['/app'],
             ['/login']
         ];
    }


    public function pageContainElement()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/app');

        // dd($crawler->filter('h1')->text());
        # $this->assertResponseIsSuccessful();
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('h1', $crawler->filter('h1')->text());

    }

    public function commonAssertionsTests()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/app');


        # Common assertions
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Hello World")')->count()); // no passed
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Hello")')->count()); // passed
        // $this->assertGreaterThan(0, $crawler->filter('h1')->count());
        // $this->assertGreaterThan(0, $crawler->filter('h1.class')->count()); verify if has attribute class on element h1
        $this->assertCount(1, $crawler->filter('h1'));


        $this->assertTrue($client->getResponse()->headers->contains(
            'Content-Type',
            'application/json'
        ),
            'the "Content-Type" header is "application/json"' // optional message shown on failure
        );


        $this->assertContains('foo', [$client->getResponse()->getContent()]);

        $this->assertRegExp('/foo(bar)?/', $client->getResponse()->getContent()); // assert Regular expression

        $this->assertTrue($client->getResponse()->isSuccessful(), 'response status is 2xx');
        $this->assertTrue($client->getResponse()->isNotFound());

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        // Client is redirected to some url address
        $this->assertTrue(
            $client->getResponse()->isRedirect('/demo/contact'),
            // if the redirection URL was generated as an absolute URL
            $client->getResponse()->isRedirect('http://localhost/demo/contact')
        );

        # Client is redirected him self
        $this->assertTrue($client->getResponse()->isRedirect());

    }

    public function clickToLinkTests()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/app');


        # Functional tests - click links
        $link = $crawler->filter('a:contains("awesome link")')
                        ->link(); // get link from html



        # If clicked we will be redirected to "/awesome-form" and getting a new crawler
        $crawler = $client->click($link);

        $this->assertContains('Remember me', [$client->getResponse()->getContent()]);
    }

    public function sendFormTests()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/awesome-form');

        $form = $crawler->selectButton('Sign in')->form();
        $form['email'] = "user@demo.com";
        $form['password'] = "user123";

        $crawler = $client->submit($form);

        // If I have successfully to login in application I'll be redirected to the home route
        $crawler = $client->followRedirect();

        // Verify if after login link we have logout link
        $this->assertEquals(1, $crawler->filter('a:contains("logout")')->count());
    }

}
