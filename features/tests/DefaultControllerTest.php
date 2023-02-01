<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/app');

        /* dd($crawler->filter('h1')->text());*/
        # $this->assertResponseIsSuccessful();
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('h1', $crawler->filter('h1')->text());
    }
}
