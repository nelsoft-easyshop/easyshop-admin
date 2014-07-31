<?php namespace Easyshop\ModelRepositories;

use Product;

class ProductRepository
{
    public function showAllProduct($isViewable=false)
    {
        $product = new Product();
        if($isViewable){
            return $product->where('is_delete', '=', 0)->where('is_draft', '=', 0, 'AND');
        }

        return $product;
    }
}
