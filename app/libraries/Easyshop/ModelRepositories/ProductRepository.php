<?php namespace Easyshop\ModelRepositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Product,ProductImage,  LocationLookUp, ProductItem, OptionalAttrDetail, OptionalAttrHead,Category, Brand, Style, Member, ProductShippingDetail, ProductShippingHead;


class ProductRepository
{

    /**
     * Get paginated products
     * @param int $row     
     * @return Entity
     */     
    public function getAll($row)
    {
        return Product::paginate($row);
    }

    
    /**
     * Get all viewable products
     * @param int $row
     * @return Entity
     */
    public function getAllViewable($row)
    {
        return Product::where('is_delete', '=', 0)
            ->where('is_draft', '=', 0, 'AND')
            ->paginate($row);
    }

    /**
     * Get number of products uploaded per month
     * @return Entity
     */ 
    public function getProductsUploadedPerMonth($month, $year)
    {
        foreach ($month as $key => $value) {
            $dt = Carbon::create($year, ++$key, 1);
            $products[] = Product::whereBetween("createddate",array((string)$dt->startOfMonth(),(string)$dt->endOfMonth()))->orderBy("createddate","asc")->count();
        }
        return $products;
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
            $product->where('es_member.store_name', 'LIKE', '%' . $userData['seller'] . '%');
        }
        if($userData['brand']){
            $product->where('es_brand.name', 'LIKE', '%' . $userData['brand'] . '%');
        }
        if($userData['category']){
            $product->where('es_cat.name', 'LIKE', '%' . $userData['category'] . '%');
        }

        return $product->select('es_product.*')->paginate($row);
    }

    /**
     *  Get product by slug
     *
     *  @param string $slug
     *  @return Entity
     */
    public function getProductBySlug($slug)
    {
         $query = DB::table('es_product')
         ->leftJoin('es_product_image', 'es_product.id_product', '=', 'es_product_image.product_id')
         ->where('es_product.slug','=', $slug)
         ->first();

        return $query;
    }    
}

