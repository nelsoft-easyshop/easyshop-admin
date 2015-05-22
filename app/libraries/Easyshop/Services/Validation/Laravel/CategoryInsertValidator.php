<?php 

namespace Easyshop\Services\Validation\Laravel;
 
class CategoryInsertValidator extends AbstractLaravelValidator
{
    /**
     * Validation for inserting new category
     *
     * @var string[]
     */
    protected $rules = [
        'parentId' => 'numeric|min:1',
        'name' => 'required|unique:es_cat',
        'slug' => 'required',
        'sortOrder' => 'numeric',
    ]; 

}

