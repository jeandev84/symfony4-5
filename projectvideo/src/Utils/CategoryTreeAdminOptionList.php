<?php
namespace App\Utils;


use App\Utils\AbstractClasses\CategoryTreeAbstract;

class CategoryTreeAdminOptionList extends CategoryTreeAbstract
{

    public function getCategoryList(array $categories, int $repeat = 0)
    {
         foreach ($categories as $category) {

             // Repeat count $repeat ( repeat "-" 1,2,3 .. times )
             $this->categoryList[] = [
                 'name' => str_repeat("-", $repeat). $category['name'],
                 'id'   => $category['id']
             ];

             if (! empty($category['children'])) {

                  $repeat = $repeat + 2;

                  $this->getCategoryList($category['children'], $repeat);

                  $repeat = $repeat - 2;
             }
         }

         return $this->categoryList;
    }
}