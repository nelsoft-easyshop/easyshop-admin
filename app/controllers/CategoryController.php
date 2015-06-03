<?php

class CategoryController extends BaseController
{
    /**
     * Display category list
     *
     * @return View
     */
    public function showAllCategory()
    {
        $userInputCatId = Input::get('id');
        $catId = (isset($userInputCatId)) ? intval(Input::get('id')) : 1;
        $categoryRepository = App::make('CategoryRepository');

        return View::make('pages.categorylist')
                   ->with('list_of_category',$categoryRepository->getChildById($catId))
                   ->with('breadcrumbs', $categoryRepository->getParentById($catId));
    }

    /**
     * Updates a category
     *
     * @return JSON
     */
    public function ajaxUpdateCategory()
    {
        $categoryManager = App::make('CategoryManager');
        $updateResult = $categoryManager->updateCategory(
            Input::get('id_cat'),            
            Input::get('name'),
            Input::get('description'),
            Input::get('keywords'),
            Input::get('sort_order')
        );

        echo json_encode($updateResult);
    }
    

    /**
     * Add a new category
     *
     * @return JSON
     */
    public function ajaxAddCategory()
    {
        $categoryManager = App::make('CategoryManager');
        
        $insertResult = $categoryManager->addNewCategory(
            Input::get('parent_id'),
            Input::get('name'),
            Input::get('description'),
            Input::get('keywords'),
            Input::get('sort_order')
        );

        echo json_encode($insertResult);
    }

    /**
     * Searches for a particular category
     *
     * @return View
     */
    public function doSearchCategory()
    {
        $categoryRepository = App::make('CategoryRepository');
        $category = $categoryRepository->search(Input::except('_token'));       
        $children = [];
        $parent = [];
        if($category){
            $categoryId = $category->id_cat;
            $children = $categoryRepository->getChildById($categoryId);
            $parent = $categoryRepository->getParentById($categoryId);
        }

        return View::make('pages.categorylist')
                   ->with('list_of_category', $children)
                   ->with('breadcrumbs', $parent);
    }

}
