<?php
namespace App\Tests\Utils;

use App\Twig\AppExtension;
use App\Utils\CategoryTreeAdminList;
use App\Utils\CategoryTreeAdminOptionList;
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


    /**
     * @var CategoryTreeAdminList
     */
   protected $mockedCategoryTreeAdminList;



   /**
     * @var CategoryTreeAdminOptionList
   */
   protected $mockedCategoryTreeAdminOptionList;


   protected function setUp(): void
   {
       $kernel = self::bootKernel();


       /** @var UrlGeneratorInterface $urlGenerator */
       $urlGenerator = $kernel->getContainer()->get('router');

       /** @var EntityManagerInterface $entityManager */
       /* $entityManager = $kernel->getContainer()->get('doctrine.orm.entity_manager'); */

       /* $categoryTree = new CategoryTreeFrontPage($entityManager, $urlGenerator); */


       /*

       $this->mockedCategoryTreeFrontPage = $this->getMockBuilder(CategoryTreeFrontPage::class)
                                                 ->disableOriginalConstructor()
                                                 ->setMethods() // if no, all methods return null unless mocked
                                                 ->getMock();


       $this->mockedCategoryTreeFrontPage->urlGenerator = $urlGenerator;
       */


       $testedClasses = [
           'CategoryTreeAdminList',
           'CategoryTreeAdminOptionList',
           'CategoryTreeFrontPage',
       ];



       foreach ($testedClasses as $treeClass) {

           $name = 'mocked'. $treeClass; // ex: mockedCategoryTreeFrontPage
           $this->{$name} = $this->getMockBuilder("App\\Utils\\{$treeClass}")
                                 ->disableOriginalConstructor()
                                 ->setMethods() // if no, all methods return null unless mocked
                                 ->getMock();


           $this->{$name}->urlGenerator = $urlGenerator;
       }

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





    /**
     * @dataProvider dataForCategoryTreeAdminOptionList
    */
    public function testCategoryTreeAdminOptionList($arrayToCompare, $arrayFromDb)
    {
         $this->mockedCategoryTreeAdminOptionList->categoriesArrayFromDb = $arrayFromDb;
         $arrayFromDb = $this->mockedCategoryTreeAdminOptionList->buildTree();
         $this->assertSame($arrayToCompare, $this->mockedCategoryTreeAdminOptionList->getCategoryList($arrayFromDb));
    }




    /**
     * @dataProvider dataForCategoryTreeAdminList
    */
    public function testCategoryTreeAdminList($string, $array)
    {
         $this->mockedCategoryTreeAdminList->categoriesArrayFromDb = $array;

         $array = $this->mockedCategoryTreeAdminList->buildTree();

         $this->assertSame($string, $this->mockedCategoryTreeAdminList->getCategoryList($array));
    }




    public function dataForCategoryTreeFrontPage()
    {
        yield [
            '<ul><li><a href="/video-list/category/computers,6">Computers</a><ul><li><a href="/video-list/category/laptops,8">Laptops</a><ul><li><a href="/video-list/category/hp,14">HP</a></li></ul></li></ul></li></ul>',
            [
                ['name'=>'Electronics','id'=>1, 'parent_id'=>null],
                ['name'=>'Computers','id'=>6, 'parent_id'=>1],
                ['name'=>'Laptops','id'=>8, 'parent_id'=>6],
                ['name'=>'HP','id'=>14, 'parent_id'=>8]
            ],
            1
        ];

        yield [
            '<ul><li><a href="/video-list/category/computers,6">Computers</a><ul><li><a href="/video-list/category/laptops,8">Laptops</a><ul><li><a href="/video-list/category/hp,14">HP</a></li></ul></li></ul></li></ul>',
            [
                ['name'=>'Electronics','id'=>1, 'parent_id'=>null],
                ['name'=>'Computers','id'=>6, 'parent_id'=>1],
                ['name'=>'Laptops','id'=>8, 'parent_id'=>6],
                ['name'=>'HP','id'=>14, 'parent_id'=>8]
            ],
            6
        ];

        yield [
            '<ul><li><a href="/video-list/category/computers,6">Computers</a><ul><li><a href="/video-list/category/laptops,8">Laptops</a><ul><li><a href="/video-list/category/hp,14">HP</a></li></ul></li></ul></li></ul>',
            [
                ['name'=>'Electronics','id'=>1, 'parent_id'=>null],
                ['name'=>'Computers','id'=>6, 'parent_id'=>1],
                ['name'=>'Laptops','id'=>8, 'parent_id'=>6],
                ['name'=>'HP','id'=>14, 'parent_id'=>8]
            ],
            8
        ];

        yield [
            '<ul><li><a href="/video-list/category/computers,6">Computers</a><ul><li><a href="/video-list/category/laptops,8">Laptops</a><ul><li><a href="/video-list/category/hp,14">HP</a></li></ul></li></ul></li></ul>',
            [
                ['name'=>'Electronics','id'=>1, 'parent_id'=>null],
                ['name'=>'Computers','id'=>6, 'parent_id'=>1],
                ['name'=>'Laptops','id'=>8, 'parent_id'=>6],
                ['name'=>'HP','id'=>14, 'parent_id'=>8]
            ],
            14

        ];
    }




    public function dataForCategoryTreeAdminOptionList()
    {

        yield [
            [
                ['name'=>'Electronics','id'=>1],
                ['name'=>'--Computers','id'=>6],
                ['name'=>'----Laptops','id'=>8],
                ['name'=>'------HP','id'=>14]
            ],
            [
                ['name'=>'Electronics','id'=>1, 'parent_id'=>null],
                ['name'=>'Computers','id'=>6, 'parent_id'=>1],
                ['name'=>'Laptops','id'=>8, 'parent_id'=>6],
                ['name'=>'HP','id'=>14, 'parent_id'=>8]
            ]
        ];

    }





    public function dataForCategoryTreeAdminList()
    {
        yield [
            '<ul class="fa-ul text-left"><li><i class="fa-li fa fa-arrow-right"></i>  Toys<a href="/admin/superadmin/edit-category/2"> Edit</a> <a onclick="return confirm(\'Are you sure?\');" href="/admin/superadmin/delete-category/2">Delete</a></li></ul>',
            [ ['id'=>2,'parent_id'=>null,'name'=>'Toys'] ]
        ];

        yield [
            '<ul class="fa-ul text-left"><li><i class="fa-li fa fa-arrow-right"></i>  Toys<a href="/admin/superadmin/edit-category/2"> Edit</a> <a onclick="return confirm(\'Are you sure?\');" href="/admin/superadmin/delete-category/2">Delete</a></li><li><i class="fa-li fa fa-arrow-right"></i>  Movies<a href="/admin/superadmin/edit-category/3"> Edit</a> <a onclick="return confirm(\'Are you sure?\');" href="/admin/superadmin/delete-category/3">Delete</a></li></ul>',
            [
                ['id'=>2,'parent_id'=>null,'name'=>'Toys'],
                ['id'=>3,'parent_id'=>null,'name'=>'Movies']
            ]
        ];

        yield [
            '<ul class="fa-ul text-left"><li><i class="fa-li fa fa-arrow-right"></i>  Toys<a href="/admin/superadmin/edit-category/2"> Edit</a> <a onclick="return confirm(\'Are you sure?\');" href="/admin/superadmin/delete-category/2">Delete</a></li><li><i class="fa-li fa fa-arrow-right"></i>  Movies<a href="/admin/superadmin/edit-category/3"> Edit</a> <a onclick="return confirm(\'Are you sure?\');" href="/admin/superadmin/delete-category/3">Delete</a><ul class="fa-ul text-left"><li><i class="fa-li fa fa-arrow-right"></i>  Horrors<a href="/admin/superadmin/edit-category/4"> Edit</a> <a onclick="return confirm(\'Are you sure?\');" href="/admin/superadmin/delete-category/4">Delete</a><ul class="fa-ul text-left"><li><i class="fa-li fa fa-arrow-right"></i>  Not so scary<a href="/admin/superadmin/edit-category/5"> Edit</a> <a onclick="return confirm(\'Are you sure?\');" href="/admin/superadmin/delete-category/5">Delete</a></li></ul></li></ul></li></ul>',

            [
                ['id'=>2,'parent_id'=>null,'name'=>'Toys'],
                ['id'=>3,'parent_id'=>null,'name'=>'Movies'],
                ['id'=>4,'parent_id'=>3,'name'=>'Horrors'],
                ['id'=>5,'parent_id'=>4,'name'=>'Not so scary']
            ]
        ];
    }




//    protected function setUpOLD(): void
//    {
//        $kernel = self::bootKernel();
//
//
//        /** @var UrlGeneratorInterface $urlGenerator */
//        $urlGenerator = $kernel->getContainer()->get('router');
//
//        /** @var EntityManagerInterface $entityManager */
//        /* $entityManager = $kernel->getContainer()->get('doctrine.orm.entity_manager'); */
//
//        /* $categoryTree = new CategoryTreeFrontPage($entityManager, $urlGenerator); */
//
//        $this->mockedCategoryTreeFrontPage = $this->getMockBuilder(CategoryTreeFrontPage::class)
//            ->disableOriginalConstructor()
//            ->setMethods() // if no, all methods return null unless mocked
//            ->getMock();
//
//
//        $this->mockedCategoryTreeFrontPage->urlGenerator = $urlGenerator;
//
//    }

}
