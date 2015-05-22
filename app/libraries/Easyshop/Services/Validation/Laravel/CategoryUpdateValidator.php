<?php 

namespace Easyshop\Services\Validation\Laravel;
 
class CategoryUpdateValidator extends AbstractLaravelValidator
{
    /**
     * Validation for updating existing category
     *
     * @var string[]
     */
    protected $rules = [
        'categoryId' => 'numeric',
        'name' => 'required',
        'sortOrder' => 'numeric',
    ]; 

}
