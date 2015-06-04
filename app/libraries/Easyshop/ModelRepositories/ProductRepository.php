<?php namespace Easyshop\ModelRepositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Product,ProductImage,  LocationLookUp, ProductItem, OptionalAttrDetail, OptionalAttrHead,Category, Brand, Style, Member, ProductShippingDetail, ProductShippingHead;

class ProductRepository
{
    /**
     * Get paginated products
     *
     * @param integer $row     
     * @return Product[]
     */     
    public function getAll($row)
    {
        return Product::paginate($row);
    }

    /**
     * Get all viewable products
     *
     * @param int $row
     * @return Product[]
     */
    public function getAllViewable($row)
    {
        return Product::where('is_delete', '=', Product::STATUS_NOT_DELETED)
                      ->where('is_draft', '=', Product::STATUS_NOT_DRAFTED, 'AND')
                      ->paginate($row);
    }

    /**
     * Get number of products uploaded per month
     *
     * @return Product[]
     */ 
    public function getProductsUploadedPerMonth($months, $year)
    {
        $products = [];
        foreach ($months as $key => $value) {
            $monthIndex = $key + 1;
            $date = Carbon::create($year, $monthIndex, 1);

            $startOfMonth = $date->startOfMonth()->format('Y-m-d H:i:s');
            $endOfMonth = $date->endOfMonth()->format('Y-m-d H:i:s');

            $products[] = Product::whereBetween("createddate", [ $startOfMonth, $endOfMonth])
                                 ->where('is_delete',Product::STATUS_NOT_DELETED)
                                 ->where('is_draft', Product::STATUS_NOT_DRAFTED)
                                 ->orderBy("createddate","asc")->count();   
        }

        return $products;
    }

    /**
     * Retrieves products based on search parameters
     *
     * @param mixed $userData
     * @param integer $row
     * @return Product[]
     */
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
     *  @return Product[]
     */
    public function getProductBySlug($slug)
    {
        $product = DB::table('es_product')
                    ->where('es_product.slug','=', $slug)
                    ->first();
        
        return $product;
    }    
    
    /**
     * Get number of active products
     *
     * @return integer
     */
    public function getActiveProductCount()
    {
        $count = DB::table('es_product')
                   ->where('is_delete','=', Product::STATUS_NOT_DELETED)
                   ->where('is_draft','=', Product::STATUS_NOT_DRAFTED)
                   ->count();
        
        return $count;
    }
    
}

