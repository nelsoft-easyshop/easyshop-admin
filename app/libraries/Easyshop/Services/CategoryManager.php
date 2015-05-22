<?php 

namespace Easyshop\Services;

use Category;

class CategoryManager
{
    /**
     * Category Create Validator
     *
     * @var Easyshop\Services\Validation\Laravel\CategoryInsertValidator
     */
    private $categoryCreateValidator;
    
    /**
     * Category Update Validator
     *
     * @var Easyshop\Services\Validation\Laravel\CategoryUpdateValidator
     */
    private $categoryUpdateValidator;

    /**
     * String helper
     *
     * @var Easyshop\Services\StringHelperService
     */
    private $stringHelper;

    /**
     * Class constructor
     *
     * @param Easyshop\Services\Validation\Laravel\CategoryInsertValidator $categoryCreateValidator
     * @param Easyshop\Services\Validation\Laravel\CategoryUpdateValidator $categoryUpdateValidator
     * @param Easyshop\Services\StringHelperService $stringHelper
     */
    public function __construct($categoryCreateValidator, $categoryUpdateValidator, $stringHelper)
    {
        $this->categoryCreateValidator = $categoryCreateValidator;
        $this->categoryUpdateValidator = $categoryUpdateValidator;
        $this->stringHelper = $stringHelper;
    }

    /**
     * Adds a new category
     *
     * @param integer $parentId
     * @param string $name
     * @param string $description
     * @param string $keywords
     * @param integer $sortOrder
     * @return mixed
     */
    public function addNewCategory($parentId = Category::ROOT_CATEGORY, $name = "", $description = "", $keywords = "", $sortOrder = 0)
    {
        $categoryData = [
            'parentId' => $parentId,
            'name' => $name,
            'description' => $description,
            'keywords' => $keywords,
            'sortOrder' => $sortOrder,
            'slug' => $this->generateSlug($name),
        ];

        $newCategory = null;
        if($this->categoryCreateValidator->with($categoryData)->passes()){
            $newCategory = new Category();
            $newCategory->parent_id = $categoryData['parentId'];
            $newCategory->name = $categoryData['name'];
            $newCategory->description = $categoryData['description'];
            $newCategory->keywords = $categoryData['keywords'];
            $newCategory->sort_order = $categoryData['sortOrder'];
            $newCategory->slug = $categoryData['slug'];
            $newCategory->save();
        }

        return [
            'newCategory' => $newCategory,
            'errors' => $this->categoryCreateValidator->errors(),
        ];
    }

    /**
     * Edits an existing category
     *
     * @param integer $categoryId
     * @param string $name
     * @param string $description
     * @param string $keywords
     * @param integer $sortOrder
     * @return mixed
     */
    public function updateCategory($categoryId = 0, $name = "", $description = "", $keywords = "", $sortOrder = 0)
    {
         $categoryData = [
            'categoryId' => $categoryId,
            'name' => $name,
            'description' => $description,
            'keywords' => $keywords,
            'sortOrder' => $sortOrder,
        ];

        $category = null;
       
        $rules = $this->categoryUpdateValidator->getRules();
        $rules['name'] = $rules['name'].'|unique:es_cat,name,'.$categoryId.',id_cat'; 
        $this->categoryUpdateValidator->setRules($rules);

        if($this->categoryUpdateValidator->with($categoryData)->passes()){
            $category = Category::find($categoryData['categoryId']);
            $category->name = $categoryData['name'];
            $category->description = $categoryData['description'];
            $category->keywords = $categoryData['keywords'];
            $category->sort_order = $categoryData['sortOrder'];
            $category->save();
        }

        return [
            'category' => $category,
            'errors' => $this->categoryUpdateValidator->errors(),
        ];
    }


    /**
     * Generate unique Slug
     *
     * @param string $categoryName
     * @return string
     */
    public function generateSlug($categoryName)
    {
        $cleanedCategoryName = $this->stringHelper->clean(strtolower($categoryName));
        $existingCategories = Category::where('es_cat.slug', '=', $cleanedCategoryName)
                                      ->get(['es_cat.slug'])->toArray();

        if(count($existingCategories) > 0) {
            $counter = 0;
            while (in_array($cleanedCategoryName ."-". ++$counter, $existingCategories));
            $cleanedCategoryName .= "-". $counter;
        }

        return $cleanedCategoryName;
    }
    
}


