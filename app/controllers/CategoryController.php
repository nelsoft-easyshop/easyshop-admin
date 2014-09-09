<?php
use Easyshop\Services\StringHelperService;
use Illuminate\Support\Facades\DB;
class CategoryController extends BaseController
{
    public function showAllCategory()
    {
        $userInputCatId = Input::get('id');
        $catId = (isset($userInputCatId)) ? intval(Input::get('id')) : 1;
        $categoryRepository = App::make('CategoryRepository');

        return View::make('pages.categorylist')
            ->with('list_of_category',$categoryRepository->getChildById($catId))
            ->with('breadcrumbs', $categoryRepository->getParentById($catId));
    }

    public function ajaxUpdateCategory()
    {
        $categoryRepository = App::make('CategoryRepository');
        $category = $categoryRepository->update(
            $categoryRepository->getById(Input::get('id_cat')),
            Input::except('_method')
        );

        echo json_encode($category);
    }

    public function ajaxAddCategory()
    {
        $categoryRepository = App::make('CategoryRepository');
        $data = Input::except('_method');
        $data['slug'] = $categoryRepository->generateSlug(
            StringHelperService::clean(strtolower($data['name']))
        );

        $category = $categoryRepository->insert($data);

        echo json_encode($category);
    }

    public function doSearchCategory()
    {
        $categoryRepository = App::make('CategoryRepository');
        $category = $categoryRepository->search(Input::except('_token'));

        return View::make('pages.categorylist')
            ->with('list_of_category',$categoryRepository->getChildById($category->id_cat))
            ->with('breadcrumbs', $categoryRepository->getParentById($category->id_cat));
    }

}
