<?php
namespace App\Utils;

use App\Twig\AppExtension;
use App\Utils\AbstractClasses\CategoryTreeAbstract;

class CategoryTreeAdminList extends CategoryTreeAbstract
{


    public $html_1 = '<ul class="fa-ul text-left">';
    public $html_2 = '<li><i class="fa-li fa fa-arrow-right"></i>';
    public $html_3 = '<a href="';
    public $html_4 = '">';
    public $html_5 = '</a><a onclick="return confirm(\'Are you sure?\');" href="';
    public $html_6 = '">';
    public $html_7 = '</a>';
    public $html_8 = '</li>';
    public $html_9 = '</ul>';



    /**
     * @var AppExtension
     */
    public $slugger;
    public $mainParentName;
    public $mainParentId;
    public $currentCategoryName;
    
    public function getCategoryList(array $categories)
    {
        $this->categoryList .=  $this->html_1;

        foreach ($categories as $category) {

            $url_edit = $this->urlGenerator->generate('edit_category', [
                'id' => $category['id']
            ]);

            $url_delete = $this->urlGenerator->generate('delete_category', [
                'id' => $category['id']
            ]);

            $this->categoryList .= $this->html_2 . $category['name'];
            $this->categoryList .= $this->html_3 . $url_edit. $this->html_4 . ' Edit';
            $this->categoryList .= $this->html_5 . $url_delete. $this->html_6 . ' Delete';
            $this->categoryList .= $this->html_7;

            if (! empty($category['children'])) {
                $this->getCategoryList($category['children']);
            }

            $this->categoryList .= $this->html_8;
        }

        $this->categoryList .=  $this->html_9;

        return $this->categoryList;
    }
}