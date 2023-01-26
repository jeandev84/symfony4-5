#### SYMFONY VERSION USED
```php 
$ bin/console about 
 -------------------- ---------------------------------------------------------------------------------- 
  Symfony                                                                                                
 -------------------- ---------------------------------------------------------------------------------- 
  Version              4.4.49                                                                            
  Long-Term Support    Yes                                                                               
  End of maintenance   11/2022 Expired                                                                   
  End of life          11/2023                                                                           
 -------------------- ---------------------------------------------------------------------------------- 
  Kernel                                                                                                 
 -------------------- ---------------------------------------------------------------------------------- 
  Type                 App\Kernel                                                                        
  Environment          dev                                                                               
  Debug                true                                                                              
  Charset              UTF-8                                                                             
  Cache directory      ./var/cache/dev (15.2 MiB)                                                        
  Log directory        ./var/log (1.9 MiB)                                                               
 -------------------- ---------------------------------------------------------------------------------- 
  PHP                                                                                                    
 -------------------- ---------------------------------------------------------------------------------- 
  Version              8.1.2-1ubuntu2.9                                                                  
  Architecture         64 bits                                                                           
  Intl locale          en_US                                                                             
  Timezone             Europe/Moscow (2022-12-13T23:22:04+03:00)                                         
  OPcache              true                                                                              
  APCu                 false                                                                             
  Xdebug               false                                                                             
 -------------------- ---------------------------------------------------------------------------------- 
  Environment (.env)                                                                                     
 -------------------- ---------------------------------------------------------------------------------- 
  APP_ENV              dev                                                                               
  APP_SECRET           83947d20f651682624e31de42e2dc9e3                                                  
  DATABASE_URL         mysql://brown:secret123456@127.0.0.1:3306/videos?serverVersion=8&charset=utf8mb4  
 -------------------- ---------------------------------------------------------------------------------- 

```


1. Make Controller 
```php 
$ bin/console make:controller FrontController
```

2. Load package Apache Pack 
```php 
$ composer require symfony/apache-pack 
```

3. Make Controller 
```php 
$ bin/console make:controller AdminController
```

 
4. Webpack Encore
- https://symfony.com/doc/current/frontend/encore/installation.html
```php
$ npm init
$ npm install @symfony/webpack-encore --save-dev 
$ touch webpack.config.js

========================= webpack.config.js ======================================
const Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/assets/')
    // public path used by the web server to access the output path
    .setPublicPath('/assets')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    //.addEntry('app', './assets/app.js')
      .addStyleEntry('css/dashboard', ['./assets/css/dashboard.css'])
      .addStyleEntry('css/login', ['./assets/css/login.css'])
      
    .enableSingleRuntimeChunk()

    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())
;

module.exports = Encore.getWebpackConfig();
==========================================================================

$ mkdir assets (Create assets folder)

$ ./node_modules/.bin/encore production
```




5. Make  Entity [ Category ]
```php
$ bin/console make:entity  Category

 Class name of the entity to create or update (e.g. DeliciousPizza):
 > Category

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > name

 Field type (enter ? to see all types) [string]:
 > 

 Field length [255]:
 > 45

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/Category.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > subcategories

 Field type (enter ? to see all types) [string]:
 > relation

 What class should this entity be related to?:
 > Category

What type of relationship is this?
 ------------ ------------------------------------------------------------------------ 
  Type         Description                                                             
 ------------ ------------------------------------------------------------------------ 
  ManyToOne    Each Category relates to (has) one Category.                            
               Each Category can relate to (can have) many Category objects            
                                                                                       
  OneToMany    Each Category can relate to (can have) many Category objects.           
               Each Category relates to (has) one Category                             
                                                                                       
  ManyToMany   Each Category can relate to (can have) many Category objects.           
               Each Category can also relate to (can also have) many Category objects  
                                                                                       
  OneToOne     Each Category relates to (has) exactly one Category.                    
               Each Category also relates to (has) exactly one Category.               
 ------------ ------------------------------------------------------------------------ 

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 > OneToMany

 A new property will also be added to the Category class so that you can access and set the related Category object from it.

 New field name inside Category [category]:
 > parent

 Is the Category.parent property allowed to be null (nullable)? (yes/no) [yes]:
 > 

 updated: src/Entity/Category.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 


           
  Success! 
           

 Next: When you're ready, create a migration with php bin/console make:migration
```



6. Make  Entity [ Video ]
```php 

 Class name of the entity to create or update (e.g. BravePuppy):
 > Video

 created: src/Entity/Video.php
 created: src/Repository/VideoRepository.php
 
 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > title

 Field type (enter ? to see all types) [string]:
 > 

 Field length [255]:
 > 

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/Video.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > path

 Field type (enter ? to see all types) [string]:
 > 

 Field length [255]:
 > 

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/Video.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > duration

 Field type (enter ? to see all types) [string]:
 > ?

Main types
  * string
  * text
  * boolean
  * integer (or smallint, bigint)
  * float

Relationships / Associations
  * relation (a wizard 🧙 will help you build the relation)
  * ManyToOne
  * OneToMany
  * ManyToMany
  * OneToOne

Array/Object Types
  * array (or simple_array)
  * json
  * object
  * binary
  * blob

Date/Time Types
  * datetime (or datetime_immutable)
  * datetimetz (or datetimetz_immutable)
  * date (or date_immutable)
  * time (or time_immutable)
  * dateinterval

Other Types
  * ascii_string
  * decimal
  * guid


 Field type (enter ? to see all types) [string]:
 > integer

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/Video.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > category

 Field type (enter ? to see all types) [string]:
 > relation

 What class should this entity be related to?:
 > Category

What type of relationship is this?
 ------------ --------------------------------------------------------------------- 
  Type         Description                                                          
 ------------ --------------------------------------------------------------------- 
  ManyToOne    Each Video relates to (has) one Category.                            
               Each Category can relate to (can have) many Video objects            
                                                                                    
  OneToMany    Each Video can relate to (can have) many Category objects.           
               Each Category relates to (has) one Video                             
                                                                                    
  ManyToMany   Each Video can relate to (can have) many Category objects.           
               Each Category can also relate to (can also have) many Video objects  
                                                                                    
  OneToOne     Each Video relates to (has) exactly one Category.                    
               Each Category also relates to (has) exactly one Video.               
 ------------ --------------------------------------------------------------------- 

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 > ManyToOne

 Is the Video.category property allowed to be null (nullable)? (yes/no) [yes]:
 > 

 Do you want to add a new property to Category so that you can access/update Video objects from it - e.g. $category->getVideos()? (yes/no) [yes]:
 > 

 A new property will also be added to the Category class so that you can access the related Video objects from it.

 New field name inside Category [videos]:
 > 

 updated: src/Entity/Video.php
 updated: src/Entity/Category.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 


           
  Success! 
           

 Next: When you're ready, create a migration with php bin/console make:migration


```



7. Create Database 
```php 
$ bin/console doctrine:database:create
```


8. Make migration file to Database
```php 
$ bin/console make:migration
```



9. Migrate to Database
```php 
$ bin/console doctrine:migrations:migrate
```



10. Make Fixtures
```php 
$ composer require orm-fixtures --dev 
$ bin/console make:fixtures CategoryFixtures

<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
          $this->loadMainCategories($manager);
    }

    

    /**
     * @param ObjectManager $manager
     * @return void
    */
    private function loadMainCategories(ObjectManager $manager)
    {
        foreach ($this->getMainCategoriesData() as $name) {
            $category = new Category();
            $category->setName($name);

            $manager->persist($category);
        }

        $manager->flush();
    }



    /**
     * @return string[]
    */
    private function getMainCategoriesData(): array
    {
         return ['Electronics', 'Toys', 'Books', 'Movies'];
    }
}

===================================================================

$ bin/console doctrine:fixtures:load

Careful, database "videos" will be purged. Do you want to continue? (yes/no) [no]:
> y  

> purging database
> loading App\DataFixtures\AppFixtures
> loading App\DataFixtures\CategoryFixtures

```


11. Refresh Migrations + Database + Fixtures
```php 
$ bin/console doctrine:schema:drop -n -q --force --full-database &&
  rm src/Migration/*.php  &&
  bin/console make:migration &&
  bin/console doctrine:migrations:migrate -n -q &&
  bin/console doctrine:fixtures:load -n -q
  

In My case migrations file (./migrations)
$ bin/console doctrine:schema:drop -n -q --force --full-database &&
  rm migrations/*.php  &&
  bin/console make:migration &&
  bin/console doctrine:migrations:migrate -n -q &&
  bin/console doctrine:fixtures:load -n -q
  

================= Will be generate next files and update database ==========
           
Success! 
       

Next: Review the new migration "migrations/Version20221207000256.php"
Then: Run the migration with php bin/console doctrine:migrations:migrate
See https://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html

```



12. Make Twig Extension ( Example : slugify )
```php 
$ bin/console make:twig-extension

The name of the Twig extension class (e.g. AppExtension):
> AppExtension

created: src/Twig/AppExtension.php

       
Success! 
       

Next: Open your new extension class and start customizing it.
Find the documentation at http://symfony.com/doc/current/templating/twig_extension.html

```

13. Make Form 
```php 
$ bin/console make:form


 The name of the form class (e.g. VictoriousPuppyType):
 > CategoryType

 The name of Entity or fully qualified model class name that the new form will be bound to (empty for none):
 > Category

 created: src/Form/CategoryType.php

           
  Success! 
           

 Next: Add fields to your form and start using it.
 Find the documentation at https://symfony.com/doc/current/forms.html

```


14. Make Unit Test ( SluggerTest )
```php 
$ bin/console make:unit-test

                                                                                                                        
 [WARNING] The "make:unit-test" command is deprecated, use "make:test" instead.                                         
                                                                                                                        


Choose a class name for your test, like:
 * UtilTest (to create tests/UtilTest.php)
 * Service\UtilTest (to create tests/Service/UtilTest.php)
 * \App\Tests\Service\UtilTest (to create tests/Service/UtilTest.php)

 The name of the test class (e.g. BlogPostTest):
 > SluggerTest

 created: tests/SluggerTest.php

           
  Success! 
           

 Next: Open your new test class and start customizing it.
 Find the documentation at https://symfony.com/doc/current/testing.html#unit-tests

====================================================================================
./tests/Twig/SluggerTest

<?php
namespace App\Tests\Twig;

use PHPUnit\Framework\TestCase;
use App\Twig\AppExtension;


class SluggerTest extends TestCase
{
    public function testSlugify(): void
    {
        $slugger = new AppExtension();

        $this->assertSame('cell-phones', $slugger->slugify('Cell Phones'));
    }
}


====================================================================================

Run Test :

$ ./bin/phpunit
#!/usr/bin/env php

PHPUnit 9.5.26 by Sebastian Bergmann and contributors.

Testing 
.                                                                   1 / 1 (100%)

Time: 00:00.005, Memory: 8.00 MB

OK (1 test, 1 assertion)

============================================================================

config file : ./tests.sh

#!/bin/bash


if [ "$2" == "-db"]
then
echo "rebuilding database ..."
php bin/console doctrine:schema:drop -n -q --force --full-database
rm migrations/*.php
php bin/console make:migration
php bin/console doctrine:migrations:migrate -n -q
php bin/console doctrine:fixtures:load -n -q
fi


if [ -n "$1"]
then
./bin/phpunit $1
else
./bin/phpunit
fi

========================================
In the terminal :


```


14. Make Unit Test ( CategoryTest )
```php 
$ bin/console make:unit-test


                                                                                                                        
 [WARNING] The "make:unit-test" command is deprecated, use "make:test" instead.                                         
                                                                                                                        


Choose a class name for your test, like:
 * UtilTest (to create tests/UtilTest.php)
 * Service\UtilTest (to create tests/Service/UtilTest.php)
 * \App\Tests\Service\UtilTest (to create tests/Service/UtilTest.php)

 The name of the test class (e.g. BlogPostTest):
 > CategoryTest

 created: tests/CategoryTest.php

           
  Success! 
           

 Next: Open your new test class and start customizing it.
 Find the documentation at https://symfony.com/doc/current/testing.html#unit-tests

========================================================================

<?php
namespace App\Tests\Utils;

use App\Twig\AppExtension;
use App\Utils\CategoryTreeFrontPage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CategoryTest extends KernelTestCase
{


   /**
     * @var CategoryTreeFrontPage
   */
   protected $mockedCategoryTreeFrontPage;


   protected function setUp(): void
   {
       $kernel = self::bootKernel();


       /** @var UrlGeneratorInterface $urlGenerator */
       $urlGenerator = $kernel->getContainer()->get('router');

       /** @var EntityManagerInterface $entityManager */
       /* $entityManager = $kernel->getContainer()->get('doctrine.orm.entity_manager'); */

       /* $categoryTree = new CategoryTreeFrontPage($entityManager, $urlGenerator); */

       $this->mockedCategoryTreeFrontPage = $this->getMockBuilder(CategoryTreeFrontPage::class)
                                                 ->disableOriginalConstructor()
                                                 ->setMethods() // if no, all methods return null unless mocked
                                                 ->getMock();


       $this->mockedCategoryTreeFrontPage->urlGenerator = $urlGenerator;

   }


    /**
     * @dataProvider dataForCategoryTreeFrontPage
    */
    public function testCategoryTreeFrontPage(string $string, array $array, int $id)
    {
         /* dd($this->mockedCategoryTreeFrontPage); */

         $this->mockedCategoryTreeFrontPage->categoriesArrayFromDb = $array;
         $this->mockedCategoryTreeFrontPage->slugger = new AppExtension();
         $main_parent_id = $this->mockedCategoryTreeFrontPage->getMainParent($id)['id'];
         $array = $this->mockedCategoryTreeFrontPage->buildTree($main_parent_id);

         $this->assertSame($string, $this->mockedCategoryTreeFrontPage->getCategoryList($array));
    }




    public function dataForCategoryTreeFrontPage()
    {
          yield [
            '<ul><li><a href="/video-list/category/computers,6">Computers</a><ul><li><a 
             href="/video-list/category/laptops,8">Laptops</a><ul><li><a href="/video-list/category/hp,14">HP</a></li></ul></li></ul></li></ul>',
            [
                ['name' => 'Electronics', 'id' => 1, 'parent_id' => null],
                ['name' => 'Computers', 'id' => 6, 'parent_id' => 1],
                ['name' => 'Laptops', 'id' => 8, 'parent_id' => 6],
                ['name' => 'HP', 'id' => 14, 'parent_id' => 8],
            ],
            1
          ];
    }

}

==================================================================================

<?php
namespace App\Tests\Utils;

use App\Twig\AppExtension;
use App\Utils\CategoryTreeFrontPage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CategoryTest extends KernelTestCase
{


   /**
     * @var CategoryTreeFrontPage
   */
   protected $mockedCategoryTreeFrontPage;


   protected function setUp(): void
   {
       $kernel = self::bootKernel();


       /** @var UrlGeneratorInterface $urlGenerator */
       $urlGenerator = $kernel->getContainer()->get('router');

       /** @var EntityManagerInterface $entityManager */
       /* $entityManager = $kernel->getContainer()->get('doctrine.orm.entity_manager'); */

       /* $categoryTree = new CategoryTreeFrontPage($entityManager, $urlGenerator); */

       $this->mockedCategoryTreeFrontPage = $this->getMockBuilder(CategoryTreeFrontPage::class)
                                                 ->disableOriginalConstructor()
                                                 ->setMethods() // if no, all methods return null unless mocked
                                                 ->getMock();


       $this->mockedCategoryTreeFrontPage->urlGenerator = $urlGenerator;

   }


    /**
     * @dataProvider dataForCategoryTreeFrontPage
    */
    public function testCategoryTreeFrontPage(string $string, array $array, int $id)
    {
         /* dd($this->mockedCategoryTreeFrontPage); */

         $this->mockedCategoryTreeFrontPage->categoriesArrayFromDb = $array;
         $this->mockedCategoryTreeFrontPage->slugger = new AppExtension();
         $main_parent_id = $this->mockedCategoryTreeFrontPage->getMainParent($id)['id'];
         $array = $this->mockedCategoryTreeFrontPage->buildTree($main_parent_id);

         $this->assertSame($string, $this->mockedCategoryTreeFrontPage->getCategoryList($array));
    }




    public function dataForCategoryTreeFrontPage()
    {
          yield [
            '<ul><li><a href="/video-list/category/cameras,5">Cameras</a></li><li><a href="/video-list/category/computers,6">Computers</a><ul><li><a href="/video-list/category/laptops,8">Laptops</a><ul><li><a href="/video-list/category/apple,10">Apple</a></li><li><a href="/video-list/category/asus,11">Asus</a></li><li><a href="/video-list/category/dell,12">Dell</a></li><li><a href="/video-list/category/lenovo,13">Lenovo</a></li><li><a href="/video-list/category/hp,14">HP</a></li></ul></li><li><a href="/video-list/category/desktops,9">Desktops</a></li></ul></li><li><a href="/video-list/category/cell-phones,7">Cell Phones</a></li></ul>',
            [
                ['name' => 'Electronics', 'id' => 1, 'parent_id' => null],
                ['name' => 'Cameras', 'id' => 5, 'parent_id' => 1],
                ['name' => 'Computers', 'id' => 6, 'parent_id' => 1],
                ['name' => 'Laptops', 'id' => 8, 'parent_id' => 5],
                ['name' => 'Apple', 'id' => 10, 'parent_id' => 8],
                ['name' => 'Asus', 'id' => 11, 'parent_id' => 8],
                ['name' => 'Dell', 'id' => 12, 'parent_id' => 8],
                ['name' => 'Lenovo', 'id' => 13, 'parent_id' => 8],
                ['name' => 'HP', 'id' => 14, 'parent_id' => 8],
                ['name' => 'Desktops', 'id' => 9, 'parent_id' => 6],
                ['name' => 'Cell Phones', 'id' => 7, 'parent_id' => 1]
            ],
            1
          ];
          
          ....
    }

}


$ ./bin/phpunit


```


15. Make Functional Test 
```php 
$ composer require browser-kit css-selector --dev
$ bin/console make:functional-test 
$ ./bin/phpunit tests/Controllers
$ ./bin/phpunit tests/Controllers/AdminControllerCategoriesTest.php
```


16. Make VideoFixtures
```php 
$ bin/console make:fixtures VideoFixtures

<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Video;
use App\Entity\Category;


class VideoFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getVideoData() as[$title, $path, $categoryId]) {
             $duration = random_int(10, 300);
             $category = $manager->getRepository(Category::class)->find($categoryId);
             $video    = new Video();
             $video->setTitle($title);
             $video->setPath('https://player.vimeo.com/video/', $path);
             $video->setCategory($category);
             $video->setDuration($duration);
             $manager->persist($video);
        }

        $manager->flush();
    }



    private function getVideoData()
    {
        return [

            ['Movies 1',289729765,4],
            ['Movies 2',238902809,4],
            ['Movies 3',150870038,4],
            ['Movies 4',219727723,4],
            ['Movies 5',289879647,4],
            ['Movies 6',261379936,4],
            ['Movies 7',289029793,4],
            ['Movies 8',60594348,4],
            ['Movies 9',290253648,4],

            ['Family 1',289729765,17],
            ['Family 2',289729765,17],
            ['Family 3',289729765,17],

            ['Romantic comedy 1',289729765,19],
            ['Romantic comedy 2',289729765,19],

            ['Romantic drama 1',289729765,20],

            ['Toys  1',289729765,2],
            ['Toys  2',289729765,2],
            ['Toys  3',289729765,2],
            ['Toys  4',289729765,2],
            ['Toys  5',289729765,2],
            ['Toys  6',289729765,2]

        ];
    }
}


$ php bin/console doctrine:fixtures:load
```


17. Pagination Video List 
```php 
https://github.com/KnpLabs/KnpPaginatorBundle
$ composer require knplabs/knp-paginator-bundle:*
```

18. Make User
```php 
$ composer require security
$ bin/console make:user


The name of the security user class (e.g. User) [User]:
> 

Do you want to store user data in the database (via Doctrine)? (yes/no) [yes]:
> 

Enter a property name that will be the unique "display" name for the user (e.g. email, username, uuid) [email]:
> 

Will this app need to hash/check user passwords? Choose No if passwords are not needed or will be checked/hashed by some other system (e.g. a single sign-on server).

Does this app need to hash/check user passwords? (yes/no) [yes]:
> 

created: src/Entity/User.php
created: src/Repository/UserRepository.php
updated: src/Entity/User.php
updated: config/packages/security.yaml

       
Success! 
       

Next Steps:
- Review your new App\Entity\User class.
- Use make:entity to add more fields to your User entity and then run make:migration.
- Create a way to authenticate! See https://symfony.com/doc/current/security.html

==================================================================================

$ bin/console make:entity User


Your entity already exists! So let's add some new fields!

New property name (press <return> to stop adding fields):
> name

Field type (enter ? to see all types) [string]:
> 

Field length [255]:
> 45

Can this field be null in the database (nullable) (yes/no) [no]:
> 

updated: src/Entity/User.php

Add another property? Enter the property name (or press <return> to stop adding fields):
> lastName

Field type (enter ? to see all types) [string]:
> 45

Main types
* string
* text
* boolean
* integer (or smallint, bigint)
* float

Relationships / Associations
* relation (a wizard 🧙 will help you build the relation)
* ManyToOne
* OneToMany
* ManyToMany
* OneToOne

Array/Object Types
* array (or simple_array)
* json
* object
* binary
* blob

Date/Time Types
* datetime (or datetime_immutable)
* datetimetz (or datetimetz_immutable)
* date (or date_immutable)
* time (or time_immutable)
* dateinterval

Other Types
* ascii_string
* decimal
* guid

                                                                                                                    
[ERROR] Invalid type "45".                                                                                             
                                                                                                                    


Field type (enter ? to see all types) [string]:
> 

Field length [255]:
> 45

Can this field be null in the database (nullable) (yes/no) [no]:
> 

updated: src/Entity/User.php

Add another property? Enter the property name (or press <return> to stop adding fields):
> vimeo_api_key

Field type (enter ? to see all types) [string]:
> 

Field length [255]:
> 

Can this field be null in the database (nullable) (yes/no) [no]:
> yes

updated: src/Entity/User.php

Add another property? Enter the property name (or press <return> to stop adding fields):
> 


       
Success! 
       

Next: When you're ready, create a migration with php bin/console make:migration
```


19. Make User Fixtures
```php 
$ bin/console make:fixtures


<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
    */
    protected $passwordEncoder;


    /**
      * @param UserPasswordEncoderInterface $passwordEncoder
    */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
         $this->passwordEncoder = $passwordEncoder;
    }




    public function load(ObjectManager $manager): void
    {

        foreach ($this->getUserData() as [$name, $lastName, $email, $password, $apiKey, $roles]) {

               $user = new User();
               $user->setName($name);
               $user->setLastName($lastName);
               $user->setEmail($email);
               $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
               $user->setVimeoApiKey($apiKey);
               $user->setRoles($roles);

               $manager->persist($user);
        }

        $manager->flush();
    }



    public function getUserData(): array
    {
        return [
            ['John', 'Wayne', 'jw@symf4.loc', 'passw', 'hjd8dehdh', ['ROLE_ADMIN']],
            ['John', 'Wayne2', 'jw2@symf4.loc', 'passw', null, ['ROLE_ADMIN']],
            ['John', 'Doe', 'jd@symf4.loc', 'passw', null, ['ROLE_USER']]
        ];
    }
}

===============================================================

$ bin/console doctrine:fixtures:load

```

20. Check Security (Security Checker)
```php 
https://security.symfony.com/check_lock
$ composer require sensiolabs/security-checker
$ bin/console security:check
In ErrorChunk.php line 64:
                                                                             
  Couldn't resolve host name for "https://security.symfony.com/check_lock".  
                                                                             

In CurlResponse.php line 311:
                                                                             
  Couldn't resolve host name for "https://security.symfony.com/check_lock".  
                                                                           
$ composer update (For resolving this error)
$ bin/console cache:clear
$ bin/console assets:install public
$ bin/console security:check
```


21. User Registration 
```php 
$ bin/console make:form


 The name of the form class (e.g. VictoriousChefType):
 > UserType

 The name of Entity or fully qualified model class name that the new form will be bound to (empty for none):
 > User

 created: src/Form/UserType.php

           
  Success! 
           

 Next: Add fields to your form and start using it.
 Find the documentation at https://symfony.com/doc/current/forms.html

========================================================================================
```


22. Make Entity Comment 
```php 
$ bin/console make:entity

Class name of the entity to create or update (e.g. GentlePizza):
 > Comment

 created: src/Entity/Comment.php
 created: src/Repository/CommentRepository.php
 
 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > content

 Field type (enter ? to see all types) [string]:
 > text

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/Comment.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > created_at

 Field type (enter ? to see all types) [datetime_immutable]:
 > datetime

 Can this field be null in the database (nullable) (yes/no) [no]:
 >     

 updated: src/Entity/Comment.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > user

 Field type (enter ? to see all types) [string]:
 > relation

 What class should this entity be related to?:
 > User

What type of relationship is this?
 ------------ ------------------------------------------------------------------- 
  Type         Description                                                        
 ------------ ------------------------------------------------------------------- 
  ManyToOne    Each Comment relates to (has) one User.                            
               Each User can relate to (can have) many Comment objects            
                                                                                  
  OneToMany    Each Comment can relate to (can have) many User objects.           
               Each User relates to (has) one Comment                             
                                                                                  
  ManyToMany   Each Comment can relate to (can have) many User objects.           
               Each User can also relate to (can also have) many Comment objects  
                                                                                  
  OneToOne     Each Comment relates to (has) exactly one User.                    
               Each User also relates to (has) exactly one Comment.               
 ------------ ------------------------------------------------------------------- 

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 > ManyToOne

 Is the Comment.user property allowed to be null (nullable)? (yes/no) [yes]:
 > no

 Do you want to add a new property to User so that you can access/update Comment objects from it - e.g. $user->getComments()? (yes/no) [yes]:
 > no

 updated: src/Entity/Comment.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > video

 Field type (enter ? to see all types) [string]:
 > relation

 What class should this entity be related to?:
 > Video

What type of relationship is this?
 ------------ -------------------------------------------------------------------- 
  Type         Description                                                         
 ------------ -------------------------------------------------------------------- 
  ManyToOne    Each Comment relates to (has) one Video.                            
               Each Video can relate to (can have) many Comment objects            
                                                                                   
  OneToMany    Each Comment can relate to (can have) many Video objects.           
               Each Video relates to (has) one Comment                             
                                                                                   
  ManyToMany   Each Comment can relate to (can have) many Video objects.           
               Each Video can also relate to (can also have) many Comment objects  
                                                                                   
  OneToOne     Each Comment relates to (has) exactly one Video.                    
               Each Video also relates to (has) exactly one Comment.               
 ------------ -------------------------------------------------------------------- 

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 > ManyToOne

 Is the Comment.video property allowed to be null (nullable)? (yes/no) [yes]:
 > no

 Do you want to add a new property to Video so that you can access/update Comment objects from it - e.g. $video->getComments()? (yes/no) [yes]:
 > 

 A new property will also be added to the Video class so that you can access the related Comment objects from it.

 New field name inside Video [comments]:
 > 

 Do you want to activate orphanRemoval on your relationship?
 A Comment is "orphaned" when it is removed from its related Video.
 e.g. $video->removeComment($comment)
 
 NOTE: If a Comment may *change* from one Video to another, answer "no".

 Do you want to automatically delete orphaned App\Entity\Comment objects (orphanRemoval)? (yes/no) [no]:
 > 

 updated: src/Entity/Comment.php
 updated: src/Entity/Video.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 


           
  Success! 
           

 Next: When you're ready, create a migration with php bin/console make:migration
======================================================================================
 
 
<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="comments")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass=CommentRepository::class)
*/
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Video::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $video;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }




    /**
     * @ORM\PrePersist
    */
    public function setCreatedAt(): self
    {
        if (isset($this->created_at2)) {
             $this->created_at = $this->created_at2;
        } else {
            $this->created_at = new \DateTime();
        }

        return $this;
    }



//    /**
//     * @ORM\PrePersist
//    */
//    public function setCreatedAtReal(\DateTimeInterface $created_at): self
//    {
//        $this->created_at = $created_at;
//
//        return $this;
//    }


    public function setCreatedAtForFixtures($created_at): self
    {
        $this->created_at2 = $created_at;

        return $this;
    }



    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getVideo(): ?Video
    {
        return $this->video;
    }

    public function setVideo(?Video $video): self
    {
        $this->video = $video;

        return $this;
    }
}

=============================================================================
$ bin/console make:fixtures
$  bin/console doctrine:fixtures:load


<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        foreach ($this->getCommentData() as [$content, $user, $video, $createdAt]) {

             $comment = new Comment();
             $user    = $manager->getRepository(User::class)->find($user);
             $video   = $manager->getRepository(Video::class)->find($video);

             $comment->setContent($content);
             $comment->setUser($user);
             $comment->setVideo($video);
             $comment->setCreatedAtForFixtures(new \DateTime($createdAt));

             $manager->persist($comment);
        }

        $manager->flush();
    }




    private function getCommentData()
    {
        return [

            ['Comment 1 Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.',1,10,'2018-10-08 12:34:45'],
            ['Comment 2 Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.',2,10,'2018-09-08 10:34:45'],
            ['Comment 3 Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.',3,10,'2018-08-08 23:34:45'],

            ['Comment 1 Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.',1,11,'2018-10-08 11:23:34'],
            ['Comment 2 Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.',2,11,'2018-09-08 15:17:06'],
            ['Comment 3 Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.',3,11,'2018-08-08 21:34:45'],
            ['Comment 4 Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.',3,11,'2018-08-08 22:34:45'],
            ['Comment 5 Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.',3,11,'2018-08-08 23:34:45']

        ];
    }



    // This method tell that the UserFixtures must be call first
    public function getDependencies(): array
    {
         return [UserFixtures::class];
    }
}

============================================================================
```


23. Transform owner "createdAt Object" to "String"
Plugin for check how
```php 
$ composer require knplabs/knp-time-bundle:*
```


24.  Bundle For Doctrine for Testing application with database 
```php 
$ composer require --dev dama/doctrine-test-bundle:*
```


25. Like and Dislike functionnalities
```php 
$ bin/console make:entity

 Class name of the entity to create or update (e.g. BraveElephant):
 > Video

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > usersThatLike

 Field type (enter ? to see all types) [string]:
 > relation

 What class should this entity be related to?:
 > User

What type of relationship is this?
 ------------ ----------------------------------------------------------------- 
  Type         Description                                                      
 ------------ ----------------------------------------------------------------- 
  ManyToOne    Each Video relates to (has) one User.                            
               Each User can relate to (can have) many Video objects            
                                                                                
  OneToMany    Each Video can relate to (can have) many User objects.           
               Each User relates to (has) one Video                             
                                                                                
  ManyToMany   Each Video can relate to (can have) many User objects.           
               Each User can also relate to (can also have) many Video objects  
                                                                                
  OneToOne     Each Video relates to (has) exactly one User.                    
               Each User also relates to (has) exactly one Video.               
 ------------ ----------------------------------------------------------------- 

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 > ManyToMany

 Do you want to add a new property to User so that you can access/update Video objects from it - e.g. $user->getVideos()? (yes/no) [yes]:
 > 

 A new property will also be added to the User class so that you can access the related Video objects from it.

 New field name inside User [videos]:
 > likedVideos

 updated: src/Entity/Video.php
 updated: src/Entity/User.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 >  usersThatDontLike
 
  Field type (enter ? to see all types) [string]:
 > relation

 What class should this entity be related to?:
 > User

 What type of relationship is this?
 ------------ ----------------------------------------------------------------- 
  Type         Description                                                      
 ------------ ----------------------------------------------------------------- 
  ManyToOne    Each Video relates to (has) one User.                            
               Each User can relate to (can have) many Video objects            
                                                                                
  OneToMany    Each Video can relate to (can have) many User objects.           
               Each User relates to (has) one Video                             
                                                                                
  ManyToMany   Each Video can relate to (can have) many User objects.           
               Each User can also relate to (can also have) many Video objects  
                                                                                
  OneToOne     Each Video relates to (has) exactly one User.                    
               Each User also relates to (has) exactly one Video.               
 ------------ ----------------------------------------------------------------- 

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 > ManyToMany

 Do you want to add a new property to User so that you can access/update Video objects from it - e.g. $user->getVideos()? (yes/no) [yes]:
 > 

 A new property will also be added to the User class so that you can access the related Video objects from it.

 New field name inside User [videos]:
 > dislikedVideos

 updated: src/Entity/Video.php
 updated: src/Entity/User.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 


           
  Success! 
           

 Next: When you're ready, create a migration with php bin/console make:migration

 

```


26. Make Entity Subscription 
```php 
$ bin/console make:entity

 Class name of the entity to create or update (e.g. VictoriousChef):
 > Subscription

 created: src/Entity/Subscription.php
 created: src/Repository/SubscriptionRepository.php
 
 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.

 New property name (press <return> to stop adding fields):
 > plan

 Field type (enter ? to see all types) [string]:
 > 

 Field length [255]:
 > 

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/Subscription.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > valid_to

 Field type (enter ? to see all types) [string]:
 > datetime

 Can this field be null in the database (nullable) (yes/no) [no]:
 > 

 updated: src/Entity/Subscription.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > payment_status

 Field type (enter ? to see all types) [string]:
 > 

 Field length [255]:
 > 45

 Can this field be null in the database (nullable) (yes/no) [no]:
 > yes

 updated: src/Entity/Subscription.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > free_plan_used

 Field type (enter ? to see all types) [string]:
 > boolean

 Can this field be null in the database (nullable) (yes/no) [no]:
 > true

 updated: src/Entity/Subscription.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 


           
  Success! 
           

 Next: When you're ready, create a migration with php bin/console make:migration

===========================================================================================


$ bin/console make:entity

Class name of the entity to create or update (e.g. OrangePizza):
 > User

 Your entity already exists! So let's add some new fields!

 New property name (press <return> to stop adding fields):
 > subscription

 Field type (enter ? to see all types) [string]:
 > relation

 What class should this entity be related to?:
 > Subscription

What type of relationship is this?
 ------------ ------------------------------------------------------------------------ 
  Type         Description                                                             
 ------------ ------------------------------------------------------------------------ 
  ManyToOne    Each User relates to (has) one Subscription.                            
               Each Subscription can relate to (can have) many User objects            
                                                                                       
  OneToMany    Each User can relate to (can have) many Subscription objects.           
               Each Subscription relates to (has) one User                             
                                                                                       
  ManyToMany   Each User can relate to (can have) many Subscription objects.           
               Each Subscription can also relate to (can also have) many User objects  
                                                                                       
  OneToOne     Each User relates to (has) exactly one Subscription.                    
               Each Subscription also relates to (has) exactly one User.               
 ------------ ------------------------------------------------------------------------ 

 Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:
 > OneToOne

 Is the User.subscription property allowed to be null (nullable)? (yes/no) [yes]:
 > 

 Do you want to add a new property to Subscription so that you can access/update User objects from it - e.g. $subscription->getUser()? (yes/no) [no]:
 > 

 updated: src/Entity/User.php

 Add another property? Enter the property name (or press <return> to stop adding fields):
 > 


           
  Success! 
           

 Next: When you're ready, create a migration with php bin/console make:migration

=====================================================================================

 bin/console make:fixture

 The class name of the fixtures to create (e.g. AppFixtures):
 > SubscriptionFixtures

 created: src/DataFixtures/SubscriptionFixtures.php

           
  Success! 
           

 Next: Open your new fixtures class and start customizing it.
 Load your fixtures by running: php bin/console doctrine:fixtures:load
 Docs: https://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html

```


27. Redis installation 
```php 
$ sudo apt-get install redis-server
$ sudo apt-get install php-redis


$ sudo nano /etc/redis/redis.conf
       maxmemory 128mb
       maxmemory-policy allkeys-lru
       
$ sudo systemctl enable redis-server.service
$ sudo service apache2 restart (or nginx if you use it)

==================================== CONFIG .env ===========================


###> redis ###

REDIS_HOST=127.0.0.1
REDIS_PORT=6379
REDIS_PASSWORD=null


============================ CONFIG THE PACKAGES FRAMEWORK =============================
./config/packages/framework.yaml

# see https://symfony.com/doc/current/reference/configuration/framework.html
framework:
    secret: '%env(APP_SECRET)%'
    #default_locale: en
    #csrf_protection: true
    #http_method_override: true

    # Enables session support. Note that the session will ONLY be started if you read or write from it.
    # Remove or comment this section to explicitly disable session support.
    session:
        # handler_id: ~
        handler_id: Symfony\Component\HttpFoundation\Session\Storage\Handler\RedisSessionHandler

    #esi: true
    #fragments: true
    php_errors:
        log: true

    cache:
    # Put the unique name of your app here: the prefix seed
    # is used to compute stable namespaces for cache keys.
    #prefix_seed: your_vendor_name/app_name

    # The app cache caches to the filesystem by default.
    # Other options include:

    # Redis
    #app: cache.adapter.redis
    #default_redis_provider: redis://localhost

    # APCu (not recommended with heavy random-write workloads as memory fragmentation can cause perf issues)
    #app: cache.adapter.apcu

===============================================================================================
./config/services.yaml

    # add more service definitions when explicit configuration is needed
    # please note that last definitions always *replace* previous ones


    Redis:
        class: Redis
        calls:
            - method: connect
              arguments:
                  - '%env(REDIS_HOST)%'
                  - '%env(int:REDIS_PORT)%'
            # If you need key prefix, uncomment line belows
            # - method: setOption
            #   arguments:
            #       - !php/const Redis::OPT_PREFIX
            #       - 'my_prefix'

    Symfony\Component\HttpFoundation\Session\Storage\Handler\RedisSessionHandler:
        arguments:
            - '@Redis'

============================ RESTART SEVICE REDIS AND CHECK YOUR BROWSER ======================

$ sudo systemctl enable redis-server.service

```