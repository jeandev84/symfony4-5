<?php
namespace App\Utils\AbstractClasses;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

abstract class CategoryTreeAbstract
{


    /**
     * @var mixed
    */
    protected static $dbconnection;




    /**
      * @var EntityManagerInterface
     */
     protected $entityManager;



     /**
      * @var UrlGeneratorInterface
     */
     public $urlGenerator;



     /**
      * @var
     */
     public $categoriesArrayFromDb;



     /**
      * @var
     */
     public $categoryList;




     /**
      * @param EntityManagerInterface $entityManager
      * @param UrlGeneratorInterface $urlGenerator
     */
     public function __construct(EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator)
     {
           $this->entityManager = $entityManager;
           $this->urlGenerator  = $urlGenerator;
           $this->categoriesArrayFromDb = $this->getCategories();
     }




     /**
      * @param array $categories Categories from database or anywhere
      * @return mixed
     */
     abstract public function getCategoryList(array $categories);





     /**
      * @param int|null $parentId
      * @return array
     */
     public function buildTree(int $parentId = null): array
     {
         $subcategories = [];

         foreach ($this->categoriesArrayFromDb as $category) {

              if ($category['parent_id'] === $parentId) {

                  $children = $this->buildTree($category['id']);

                  if ($children) {
                      $category['children'] = $children;
                  }

                  $subcategories[] = $category;
              }
         }

         return $subcategories;
     }



     private function getCategories(): array
     {
          if (self::$dbconnection) {
              return self::$dbconnection;
          }

          $conn   = $this->entityManager->getConnection();
          $sql    = "SELECT * FROM categories";
          $stmt   = $conn->prepare($sql);
          $result = $stmt->executeQuery();

          return self::$dbconnection = $result->fetchAll();

     }
}