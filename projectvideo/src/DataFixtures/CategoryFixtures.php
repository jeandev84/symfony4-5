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
          $this->loadElectronics($manager);
          $this->loadComputers($manager);
          $this->loadLaptops($manager);
          $this->loadBooks($manager);
          $this->loadMovies($manager);
          $this->loadRomance($manager);
    }



    /**
     * @param ObjectManager $manager
     * @return void
    */
    private function loadMainCategories(ObjectManager $manager)
    {
        foreach ($this->getMainCategoriesData() as [$name]) {
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
         return [
             ['Electronics', 1],
             ['Toys', 2],
             ['Books', 3],
             ['Movies', 4],
         ];
    }





    /**
     * @param ObjectManager $manager
     * @param string $categoryName
     * @param int $parentId
     * @return void
    */
    private function loadSubCategories(ObjectManager $manager, string $categoryName, int $parentId)
    {
        $parent = $manager->getRepository(Category::class)->find($parentId);
        $methodName = "get{$categoryName}Data";

        foreach ($this->{$methodName}() as [$name]) {
            $category = new Category();
            $category->setName($name);
            $category->setParent($parent);
            $manager->persist($category);
        }

        $manager->flush();
    }





    /**
     * @param ObjectManager $manager
     * @return void
    */
    private function loadElectronics(ObjectManager $manager)
    {
         $this->loadSubCategories($manager, 'Electronics', 1);
    }





    /**
     * @param ObjectManager $manager
     * @return void
     */
    private function loadComputers(ObjectManager $manager)
    {
        $this->loadSubCategories($manager, 'Computers', 6);
    }




    private function loadLaptops(ObjectManager $manager)
    {
        $this->loadSubCategories($manager, 'Laptops', 8);
    }





    /**
     * @param ObjectManager $manager
     * @return void
     */
    private function loadBooks(ObjectManager $manager)
    {
        $this->loadSubCategories($manager, 'Books', 3);
    }



    /**
     * @param ObjectManager $manager
     * @return void
    */
    private function loadMovies(ObjectManager $manager)
    {
        $this->loadSubCategories($manager, 'Movies', 4);
    }




    /**
     * @param ObjectManager $manager
     * @return void
     */
    private function loadRomance(ObjectManager $manager)
    {
        $this->loadSubCategories($manager, 'Romance', 18);
    }





    /**
     * @return string[]
     */
    private function getElectronicsData(): array
    {
        return [
            ['Cameras', 5],
            ['Computers', 6],
            ['Cell Phones', 7]
        ];
    }





    private function getComputersData()
    {
        return [
            ['Laptops', 8],
            ['Desktops', 9]
        ];
    }




    private function getLaptopsData()
    {
         return [
             ['Apple', 10],
             ['Asus', 11],
             ['Dell', 12],
             ['Lenovo', 13],
             ['HP', 14],
         ];
    }




    private function getBooksData()
    {
         return [
            ['Children\'s Books', 15],
            ['Kindle eBooks', 16]
         ];
    }




    private function getMoviesData()
    {
        return [
            ['Family', 17],
            ['Romance', 18]
        ];
    }





    private function getRomanceData()
    {
         return [
           ['Romantic Comedy', 19],
           ['Romantic Drama', 20],
         ];
    }




//
//    /**
//     * @param ObjectManager $manager
//     * @return void
//    */
//    private function loadSimpleMainCategories(ObjectManager $manager)
//    {
//        foreach ($this->getMainCategoriesData() as $name) {
//            $category = new Category();
//            $category->setName($name);
//            $manager->persist($category);
//        }
//
//        $manager->flush();
//    }
//
//
//
//    private function loadMainCategoriesWithID(ObjectManager $manager)
//    {
//        foreach ($this->getMainCategoriesData() as [$name, $id]) {
//            $category = new Category();
//            $category->setName($name);
//            $manager->persist($category);
//        }
//
//        $manager->flush();
//    }
//
//
//
//
//    /**
//     * @param ObjectManager $manager
//     * @return void
//    */
//    private function loadElectronicsData(ObjectManager $manager)
//    {
//        foreach ($this->getElectronicsData() as [$name]) {
//            $parent = $manager->getRepository(Category::class)->find(1);
//            $category = new Category();
//            $category->setName($name);
//            $category->setParent($parent);
//            $manager->persist($category);
//        }
//
//        $manager->flush();
//    }
}
