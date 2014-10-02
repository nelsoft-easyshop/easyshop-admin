<?php namespace Easyshop\ModelRepositories;


use Illuminate\Support\Facades\DB;
use Product,ProductImage,  LocationLookUp, ProductItem, OptionalAttrDetail, OptionalAttrHead,Category, Brand, Style, Member, ProductShippingDetail, ProductShippingHead;


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
         ->get();

        return $query;
    }  

    /**
     * Inserts Data 
     * @param object $productsObject
     * @param object $optionalAttributesObject
     * @param object $shipmentObject
     */ 
    public function insertData($productsObject, $optionalAttributesObject, $shipmentObject, $imagesObject)
    {
        $images = array();
        $attrHeadArray = array();
        foreach($productsObject as $value) {

            $category = Category::where("name",$value->category_name)->first();
            $brand = Brand::where("name",$value->brand_name)->first();
            $style = Style::where("name",$value->style)->first();
            $member = Member::where("username",$value->seller)->first();
                                        
            try{
                $product = new Product();
                $product->name = $value->product_name;
                $product->brief = $value->brief_description;
                $product->description = $value->product_description;
                $product->keywords = $value->keywords;
                $product->cat_id = $category->id_cat;
                $product->brand_id = $brand->id_brand;
                $product->style_id = $style->id_style;
                $product->member_id = $member->id_member;
                $product->discount = $value->discount;
                $product->is_cod = $value->cash_on_delivery;
                $product->slug = $value->slug;
                $product->condition = $value->condition;
                $product->keywords = $value->keywords;
                $product->price = $value->price;
                $product->save(); 

                $resultsIDS[] = $product->id_product; 
              
                $productItem = new ProductItem();
                $productItem->product_id = $product->id_product;
                $productItem->quantity = $value->quantity;
                $productItem->save();

                $productImage = new ProductImage();
                $productImage->product_image_path = "assets/product/".$value->product_image_file;
                $extension = substr($value->product_image_file, strpos($value->product_image_file, ".") + 1);
                $productImage->product_image_type = $extension;
                $productImage->product_id = $product->id_product;
                $productImage->is_primary = "1";
                $productImage->save();  

                foreach($imagesObject as $images) {
                    if($value->number === $images->product_number) {
                        $productImage = new ProductImage();
                        $productImage->product_image_path = "assets/product/".$images->product_image_file;
                        $extension = substr($images->product_image_file, strpos($images->product_image_file, ".") + 1);
                        $productImage->product_image_type = $extension;
                        $productImage->product_id = $product->id_product;
                        $productImage->is_primary = "0";
                        $productImage->save();  
                    }

                    $imagesArr[] = $productImage->id_product_image;
                    $imagesIDsArr[] = $productImage->product_image_path;
                }                
                foreach($optionalAttributesObject as $attributes){
                    if($value->number === $attributes->product_number) {
                        if(!in_array($attributes->option_name, $attrHeadArray)) {
                            $attrHeadArray[] = $attributes->option_name;
                            $attrHead = new OptionalAttrHead();
                            $attrHead->product_id = $product->id_product;
                            $attrHead->field_name = $attributes->option_name;
                            $attrHead->save();                   
                        }

                        $attrDetail = new OptionalAttrDetail();
                        $attrDetail->head_id = $attrHead->id_optional_attrhead;
                        $attrDetail->value_name = $attributes->option_value;
                        $attrDetail->value_price = $attributes->option_price;

                        foreach ($imagesArr as $imageId) {
                            $images = ProductImage::find($imageId);                            
                            if(strtolower(str_replace("assets/product/", "", $images->product_image_path)) === $attributes->option_image){
                                 $attrDetail->product_img_id = $images->id_product_image;
                                 break;
                            }
                        }
                        $attrDetail->save();   
                    }
                }
                $attrHeadArray = array();

                foreach($shipmentObject as $shipment) {
                    if($value->number === $shipment->product_number) {
                        $location = LocationLookUp::where("location",$shipment->shipping_location)->first();
                        $shippingHead = new ProductShippingHead;
                        $shippingHead->location_id = $location->id_location;
                        $shippingHead->price = $shipment->shipping_price;             
                        $shippingHead->product_id = $product->id_product;    
                        $shippingHead->save();

                        $shippingDetail = new ProductShippingDetail;
                        $shippingDetail->shipping_id = $shippingHead->id_shipping;
                        $shippingDetail->product_item_id = $productItem->id_product_item;
                        $shippingDetail->save();                        
                    }
                }
            } 
            catch(\Exception $e) {
                return $resultsIDS[] = "error";
            }
        }   
        return $resultsIDS;
    }   
}

