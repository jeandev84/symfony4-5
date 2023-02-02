<?php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DefaultControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $this->sendFormTests();
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
