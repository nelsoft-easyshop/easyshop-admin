<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use ProductImage;

class ProductImageRepository
{
    /**
     * Get Default Product Image
     *
     */     
    public function getDefaultProductImage($productId)
    {
        $productImage = ProductImage::where('es_product_image.product_id','=', $productId)
                                    ->where('es_product_image.is_primary' , '=', 1)
                                    ->first();
        return $productImage;
    }

}

