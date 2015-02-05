<?php namespace Easyshop\Services;

use Product;
use ProductImage;
use ProductItem; 
use OptionalAttrDetail;
use OptionalAttrHead;
use ProductShippingDetail;
use ProductShippingHead;
use Category, Brand, Style, Member, LocationLookUp;
use Carbon\Carbon;

class ProductCSVService
{
    /**
     * Removes data from the current csv files that was detected to have errors in table dependencies
     * @param object $values
     */ 
    public function removeErrorData($productsObject)
    {
        foreach ($productsObject as $value ) {

            $product = Product::where("slug",$value->slug)->first();
            if(!$product) {
                continue;
            }
            $headObject = OptionalAttrHead::where('product_id','=',$product->id_product)->get();            

            foreach ($headObject as $head) {
                OptionalAttrDetail::where('head_id','=',$head->id_optional_attrhead)->delete(); 
            }
            OptionalAttrHead::where('product_id','=',$product->id_product)->delete();  
            ProductImage::where('product_id','=',$product->id_product)->delete();
            $productItem = ProductItem::where('product_id','=',$product->id_product)->first();
            ProductShippingDetail::where('product_item_id','=',$productItem->id_product_item)->delete();
            ProductShippingHead::where('product_id','=',$product->id_product)->delete();
            ProductItem::where('product_id','=',$product->id_product)->delete();
            Product::find($product->id_product)->delete();                                
        }
    }

    /**
     * Inserts Data 
     * @param object $productsObject
     * @param object $optionalAttributesObject
     * @param object $shipmentObject
     */ 
    public function insertData($productsObject, $optionalAttributesObject, $shipmentObject, $imagesObject)
    {
        $images = [];
        $attrHeadArray = [];
        $resultsIDS = [];
        $errors = [];

        foreach($productsObject as $key => $value) {
            try{
                $category = Category::where("name",$value->category_name)->first();
                if(!$category) {
                    $errors[] = "Category '$value->category_name'  does not exist";
                }
                $brand = Brand::where("name",$value->brand_name)->first();
                if(!$brand) {
                    $errors[] = "Brand '$value->category_name' does not exist";                
                }
                $style = Style::where("name",$value->style)->first();
                if(!$style) {
                    $errors[] = "Style '$value->style' does not exist";
                }
                $member = Member::where("username",$value->seller)->first();
                if(!$member) {
                    $errors[] = "Seller '$value->seller' does not exist";
                }
                
                if(!empty($errors)) {
                    return ["dataNotFound" => $errors];
                }

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
                $product->condition = $value->condition;
                $product->keywords = $value->keywords;
                $product->price = $value->price;
                $product->createddate = Carbon::now();
                $product->lastmodifieddate = Carbon::now();
                $product->startdate = Carbon::now();
                $product->enddate = Carbon::now();
                $product->save(); 

                $resultsIDS[] = $product->id_product; 
              
                $productItem = new ProductItem();
                $productItem->product_id = $product->id_product;
                $productItem->quantity = $value->quantity;
                $productItem->save();

                $primaryImage = trim($value->product_image_file);
                foreach($imagesObject as $images) {
                    if($value->number === $images->product_number) {
                        $imageFile = trim($images->product_image_file);
                        $productImage = new ProductImage();
                        $productImage->product_image_path = "assets/product/".$imageFile;
                        $extension = substr($imageFile, strpos($imageFile, ".") + 1);
                        $productImage->product_image_type = $extension;
                        $productImage->product_id = $product->id_product;
                        $productImage->is_primary = ($primaryImage === $imageFile) ? "1" : "0";
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
                return $resultsIDS[] = "Database Error";
            }
        }   
        return $resultsIDS;
    }      

}
