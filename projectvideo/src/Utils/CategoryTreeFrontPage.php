<?php
namespace App\Utils;

use App\Twig\AppExtension;
use App\Utils\AbstractClasses\CategoryTreeAbstract;


class CategoryTreeFrontPage extends CategoryTreeAbstract
{

    public $html_1 = '<ul>';
    public $html_2 = '<li>';
    public $html_3 = '<a href="';
    public $html_4 = '">';
    public $html_5 = '</a>';
    public $html_6 = '</li>';
    public $html_7 = '</ul>';


    /**
     * @var AppExtension
    */
    public $slugger;
    public $mainParentName;
    public $mainParentId;
    public $currentCategoryName;


    public function getCategoryListAndParent(int $id): string
    {
        // Twig Extension to slugify url's for categories
         $this->slugger = new AppExtension();


         // main parent of subcategory
         $parentData = $this->getMainParent($id);

         // for accessing in view
         $this->mainParentName = $parentData['name'];
         $this->mainParentId   = $parentData['id'];

         // for accessing in view
         $key = array_search($id, array_column($this->categoriesArrayFromDb, 'id'));
         $this->currentCategoryName = $this->categoriesArrayFromDb[$key]['name'];

         // builds array for generating nested html list
         $categories = $this->buildTree($parentData['id']);

         return $this->getCategoryList($categories);
    }



    public function getCategoryList(array $categories)
    {
         $this->categoryList .=  $this->html_1;

         foreach ($categories as $category) {

             /* $categoryName = $category['name']; */

             $categoryName = $this->slugger->slugify($category['name']);

             $url = $this->urlGenerator->generate('video_list', [
                 'categoryname' => $categoryName,
                 'id'           => $category['id']
             ]);

             $this->categoryList .= sprintf('%s%s%s%s%s%s',
                 $this->html_2,
                 $this->html_3,
                 $url,
                 $this->html_4,
                 $category['name'],
                 $this->html_5
             );

             if (! empty($category['children'])) {
                 $this->getCategoryList($category['children']);
             }

             $this->categoryList .= $this->html_6;
         }

         $this->categoryList .=  $this->html_7;

         return $this->categoryList;
    }




    public function getMainParent(int $id): array
    {
        $key = array_search($id, array_column($this->categoriesArrayFromDb, 'id'));

        if ($this->categoriesArrayFromDb[$key]['parent_id'] != null) {
             return $this->getMainParent($this->categoriesArrayFromDb[$key]['parent_id']);
        } else {
            return [
                'id'   => $this->categoriesArrayFromDb[$key]['id'],
                'name' => $this->categoriesArrayFromDb[$key]['name']
            ];
        }
    }




    public function getChildIds(int $parent): array
    {
         static $ids = [];

         foreach ($this->categoriesArrayFromDb as $category) {

                if ($category['parent_id'] == $parent) {
                     $ids[] = $category['id'].',';
                     $this->getChildIds($category['id']);
                }
         }

         return $ids;
    }
}