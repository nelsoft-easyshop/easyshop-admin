<?php
use Illuminate\Support\Facades\DB;
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
        $categoryRepository = App::make('CategoryRepository');
        $category = $categoryRepository->update(
            $categoryRepository->getById(Input::get('id_cat')),
            Input::except('_method')
        );

        echo json_encode($category);
    }
    

    /**
     * Add a new category
     *
     * @return JSON
     */
    public function ajaxAddCategory()
    {
        $categoryRepository = App::make('CategoryRepository');
        $data = Input::except('_method');
        $data['slug'] = $categoryRepository->generateSlug(
            StringHelper::clean(strtolower($data['name']))
        );

        $category = $categoryRepository->insert($data);

        echo json_encode($category);
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

        return View::make('pages.categorylist')
                   ->with('list_of_category',$categoryRepository->getChildById($category->id_cat))
                   ->with('breadcrumbs', $categoryRepository->getParentById($category->id_cat));
    }

}
