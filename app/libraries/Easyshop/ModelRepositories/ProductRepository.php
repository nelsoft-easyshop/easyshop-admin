<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use Product,ProductImage;

class ProductRepository
{

    /**
    * Get order by id
    *
    * @param string $slug
    * @return Entity
    */
    
    public function getProductBySlug($slug)
    {
         $query = DB::table('es_product')
         ->leftJoin('es_product_image', 'es_product.id_product', '=', 'es_product_image.product_id')
         ->where('es_product.slug','=', $slug)
         ->get();

        return $query;
    }                 
         
}

