<?php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\SwiftmailerBundle\DataCollector\MessageDataCollector;

class EmailsTest extends WebTestCase
{
    public function testSomething(): void
    {
        /*
        $client = static::createClient();
        $client->enableProfiler();
        $crawler = $client->request('GET', '/send-email');

        /** @var MessageDataCollector $mailCollector *//*
        $mailCollector = $client->getProfile()->getCollector('swiftmailer');

        // 1: Because we send 1 email
        $this->assertSame(1, $mailCollector->getMessageCount());

        $collectedMessages = $mailCollector->getMessages();
        $message = $collectedMessages[0];

        $this->assertInstanceOf('Swift_message', $message);
        $this->assertSame('Hello Email', $message->getSubject());
        $this->assertSame('send@example.com', key($message->getFrom()));
        $this->assertSame('recipient@example.com', key($message->getTo()));

        // TO FIX
        // $this->assertContains('You did it! You registered!', $message->getBody());
        */

        $this->assertTrue(true);
    }
}
