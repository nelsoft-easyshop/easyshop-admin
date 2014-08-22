<?php namespace Easyshop\ModelRepositories;

use Product;

class ProductRepository
{
    public function getAll($row)
    {
        return Product::paginate($row);
    }

    public function getAllViewable($row)
    {
        return Product::where('is_delete', '=', 0)
            ->where('is_draft', '=', 0, 'AND')
            ->paginate($row);
    }

    public function search($userData,$row=50)
    {
        $product = Product::join('es_member', 'es_member.id_member', '=', 'es_product.member_id')
            ->join('es_brand', 'es_brand.id_brand', '=', 'es_product.brand_id')
            ->join('es_cat', 'es_cat.id_cat', '=', 'es_product.cat_id')
            ->where('es_product.is_delete', '=', 0)->where('es_product.is_draft', '=', 0, 'AND');
        if($userData['item']){
            $product->where('es_product.name', 'LIKE', '%' . $userData['item'] . '%');
        }
        if($userData['condition']){
            $product->where('es_product.condition', 'LIKE', '%' . $userData['condition'] . '%');
        }
        if(($userData['startdate']) && ($userData['enddate'])){
            $product->where('es_product.createddate', '>=', str_replace('/', '-', $userData['startdate']) . ' 00:00:00' )
                ->where('es_product.createddate', '<=', str_replace('/', '-', $userData['enddate']) . ' 23:59:59', 'AND');
        }
        if($userData['seller']){
            $product->where('es_member.username', 'LIKE', '%' . $userData['seller'] . '%');
        }
        if($userData['brand']){
            $product->where('es_brand.name', 'LIKE', '%' . $userData['brand'] . '%');
        }
        if($userData['category']){
            $product->where('es_cat.name', 'LIKE', '%' . $userData['category'] . '%');
        }

        return $product->select('es_product.*')->paginate($row);
    }
}
