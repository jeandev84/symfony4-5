<?php
namespace App\Tests\Controllers\Admin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AdminControllerSecurityTest extends WebTestCase
{

    /**
     * @dataProvider getUrlsForRegularUsers
    */
    public function testAccessDeniedForRegularUsers(string $httpMethod, string $url): void
    {
        $client = static::createClient();

        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'jw@symf4.loc',
            'PHP_AUTH_PW'   => 'passw'
        ]);

       $client->request($httpMethod, $url);
       $this->assertSame(Response::HTTP_FORBIDDEN, $client->getResponse()->getStatusCode());
    }




    public function getUrlsForRegularUsers()
    {
         yield['GET', '/admin/superadmin/categories'];
         yield['GET', '/admin/superadmin/edit-category/1'];
         yield['GET', '/admin/superadmin/delete-category/1'];
         yield['GET', '/admin/superadmin/users'];
         yield['GET', '/admin/superadmin/upload-video-locally'];
         yield['GET', '/admin/superadmin/upload-video-by-vimeo'];
    }



    public function testAdminSu()
    {
         $client = static::createClient([], [
             'PHP_AUTH_USER' => 'jw@symf4.loc',
             'PHP_AUTH_PW'   => 'passw'
         ]);

         $crawler = $client->request('GET', '/admin/superadmin/categories');
         $this->assertSame('Categories list', $crawler->filter('h2')->text());
    }
}
