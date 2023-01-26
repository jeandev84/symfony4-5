<?php

namespace App\Tests\Controllers\Admin;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerUserAccountTest extends WebTestCase
{
    use App\Tests\RoleUser;;

    public function testUserDeletedAccount(): void
    {
         $crawler = $this->client->request('GET', '/admin/delete-account');

         $user = $this->entityManager->getRepository(User::class)->find(3);

         $this->assertNull($user);
    }



    public function testUserChangedPassword()
    {
        $crawler = $this->client->request('GET', '/admin/');

        $form = $crawler->selectButton('Save')->form([
             'user[name]'             => 'name',
             'user[last_name]'        => 'last name',
             'user[email]'            => 'email',
             'user[password][first]'  => 'password',
             'user[password][second]' => 'password'
        ]);

        $this->client->submit($form);

        $user = $this->entityManager->getRepository(User::class)->find(3);

        $this->assertSame('name', $user->getName());
    }
}
