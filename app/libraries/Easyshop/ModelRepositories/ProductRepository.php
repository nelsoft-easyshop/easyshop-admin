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
    public function getAllProducts()
    {
        return Product::all();
    }
    
    public function getProductBySlug($slug)
    {
         $query = DB::table('es_product')
         ->leftJoin('es_product_image', 'es_product.id_product', '=', 'es_product_image.product_id')
         ->where('es_product.slug','=', $slug)
         ->get();

        return $query;

    }                      


/*
    public function getProductImage($id)
    {
        return Product::find($id)->imageProduct;
    }

        public function getProductBySlug($slug)
    {
        return Product::where('slug', $slug)->pluck('price');
    }
    */
     
}

