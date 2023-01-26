<?php
namespace App\Controller\Admin\Superadmin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Utils\CategoryTreeAdminList;
use App\Utils\CategoryTreeAdminOptionList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/superadmin")
 */
class CategoriesController extends AbstractController
{
    /**
     * @Route("/categories", name="categories", methods={"GET", "POST"})
    */
    public function categories(CategoryTreeAdminList $categoryTree, Request $request): Response
    {
            $categoryTree->getCategoryList($categoryTree->buildTree()); /* dump($categoryTree); */

            $category = new Category();

            $form = $this->createForm(CategoryType::class, $category);
            $is_valid   = null;

            if ($this->saveCategory($category, $form, $request)) {
                return $this->redirectToRoute('categories');
            } elseif($request->isMethod('post')) {
                $is_valid = ' is-invalid';
            }


            return $this->render('admin/categories.html.twig', [
                'categories' => $categoryTree->categoryList,
                'form'       => $form->createView(),
                'is_valid'   => $is_valid
            ]);
    }





    /**
     * @Route("/edit-category/{id}", name="edit_category", methods={"GET", "POST"})
    */
    public function editCategory(Category $category, Request $request): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $is_valid  = null;

        if ($this->saveCategory($category, $form, $request)) {
            return $this->redirectToRoute('categories');
        } elseif($request->isMethod('post')) {
            $is_valid = ' is-invalid';
        }


        return $this->render('admin/edit_category.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
            'is_valid'   => $is_valid
        ]);
    }




    /**
     * @Route("/delete-category/{id}", name="delete_category")
     */
    public function deleteCategory(Category $category): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($category);
        $entityManager->flush();

        return $this->redirectToRoute('categories');
    }





    /**
     * @param $category
     * @param $form
     * @param $request
     * @return bool
    */
    private function saveCategory($category, $form, $request)
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $category->setName($request->request->get('category')['name']);
            $repository = $this->getDoctrine()->getRepository(Category::class);
            $parent = $repository->find($request->request->get('category')['parent']);
            $category->setParent($parent);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return true;

        }

        return false;
    }






    /**
     * @param CategoryTreeAdminOptionList $categoryTree
     * @param $editedCategory
     * @return Response
    */
    public function getAllCategories(CategoryTreeAdminOptionList $categoryTree, $editedCategory = null): Response
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $categoryTree->getCategoryList($categoryTree->buildTree());

        return $this->render('admin/widgets/_all_categories.html.twig', [
            'categories'     => $categoryTree,
            'editedCategory' => $editedCategory
        ]);
    }




//    public function categoriesBusinessLogic(CategoryTreeAdminList $categoryTree, Request $request): Response
//    {
//        $categoryTree->getCategoryList($categoryTree->buildTree()); /* dump($categoryTree); */
//
//        $category = new Category();
//
//        $form = $this->createForm(CategoryType::class, $category);
//        $is_valid   = null;
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//
//            $category->setName($request->request->get('category')['name']);
//            $repository = $this->getDoctrine()->getRepository(Category::class);
//            $parent = $repository->find($request->request->get('category')['parent']);
//            $category->setParent($parent);
//
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($category);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('categories');
//
//        } elseif($request->isMethod('post')) {
//
//            $is_valid = ' is-invalid';
//        }
//
//
//        return $this->render('admin/categories.html.twig', [
//            'categories' => $categoryTree->categoryList,
//            'form'       => $form->createView(),
//            'is_valid'   => $is_valid
//        ]);
//    }

}