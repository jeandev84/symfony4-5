<?php
namespace App\Tests\Controllers\Admin;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerCategoriesTest extends WebTestCase
{

    use \RoleAdmin;

    public function testTextOnPage(): void
    {
        $crawler = $this->client->request('GET', '/admin/superadmin/categories');

        $this->assertSame('Categories list', $crawler->filter('h2')->text());
       // $this->assertContains('Electronics', $this->client->getResponse()->getContent());

        /*
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Hello World', $crawler->filter('h1')->text());
        ================================================================================
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello World');
        */


    }




    public function testNumberOfItems()
    {
          $crawler = $this->client->request('GET', '/admin/superadmin/categories');

          // map count of categories options list
          $this->assertCount(21, $crawler->filter('option'));
    }




    public function testNewCategory()
    {
         $crawler = $this->client->request('GET', '/admin/superadmin/categories');

         $form = $crawler->selectButton('Add')->form([
             'category[parent]' => 1,
             'category[name]'   => 'Other electronics',
         ]);

         $this->client->submit($form);


         $category = $this->entityManager->getRepository(Category::class)->findOneBy([
             'name' => 'Other electronics'
         ]);

         $this->assertNotNull($category);

         $this->assertSame('Other electronics', $category->getName());
    }



    public function testEditCategory()
    {
         $crawler = $this->client->request('GET', '/admin/superadmin/edit-category/1');

         $form = $crawler->selectButton('Save')->form([
             'category[parent]' => 0,
             'category[name]'  => 'Electronics 2'
         ]);

         $this->client->submit($form);

         $category = $this->entityManager->getRepository(Category::class)->find(1);

         $this->assertSame('Electronics 2', $category->getName());
    }




    public function testDeleteCategory()
    {
        $crawler  = $this->client->request('GET', '/admin/superadmin/delete-category/1');
        $category = $this->entityManager->getRepository(Category::class)->find(1);

        $this->assertNull($category);
    }
}
