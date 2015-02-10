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

            $product = Product::find($value);
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
        $errors = [];
        $resultsIDS["partialProductIds"] = [];
        foreach($productsObject as $key => $value) {
            try{
                $category = trim($value->category_name) !== "" ?
                            Category::where("name",$value->category_name)->first() : false;
                if(!$category) {
                    $errors[] = "Category '$value->category_name'  does not exist";
                }
                $brand = trim($value->brand_name) !== "" ?
                         Brand::where("name",$value->brand_name)->first() : false;
                if(!$brand) {
                    $errors[] = "Brand '$value->category_name' does not exist";                
                }

                $member = trim($value->seller) !== "" ?
                          Member::where("username",$value->seller)->first() : false;
                if(!$member) {
                    $errors[] = "Seller '$value->seller' does not exist";
                }

                if(trim($value->product_name) === "") {
                    $errors[] = "Product Name is required";
                }

                if(trim($value->condition) === "" || !in_array($value->condition,  
                        ['New', 'New other (see details)','Manufacturer refurbished','Used','For parts or not working'])) {
                    $errors[] = "Invalid Product Conditions";
                }

                if(!is_numeric($value->price)) {
                    $errors[] = "Invalid Product Price";
                }

                if(!is_numeric($value->discount)) {
                    $errors[] = "Invalid Discount Price";
                }

                if(!in_array($value->cash_on_delivery, [0,1])) {
                    $errors[] = "Invalid value for Cash on Delivery";
                }

                if(trim($value->product_image_file) === "") {
                    $errors[] = "Please indicate a product image";
                }

                if(!is_numeric($value->quantity)) {
                    $errors[] = "Invalid quantity value";
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
                $product->member_id = $member->id_member;
                $product->discount = $value->discount;
                $product->is_cod = $value->cash_on_delivery;
                $product->condition = $value->condition;
                $product->keywords = $value->keywords;
                $product->price = $value->price;
                $product->style_id = Style::DEFAULT_STYLE_ID;
                $product->createddate = Carbon::now();
                $product->lastmodifieddate = Carbon::now();
                $product->startdate = Carbon::now();
                $product->enddate = Carbon::now();
                $product->save(); 

                $resultsIDS["partialProductIds"][] = $product->id_product; 
              
                $productItem = new ProductItem();
                $productItem->product_id = $product->id_product;
                $productItem->quantity = $value->quantity;
                $productItem->save();
                $errors = [];
                $primaryImage = trim($value->product_image_file);
                foreach($imagesObject as $images) {
                    if($value->number === $images->product_number) {
                        if(trim($images->product_image_file) === "") {
                            $errors[] = "Invalid value for image file. Kindly check your Image sheet";
                            return ["dataNotFound" => $errors];
                        }
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

                $errors = [];
                foreach($optionalAttributesObject as $attributes){
                    if($value->number === $attributes->product_number) {
                        if(trim($attributes->option_name) === ""
                           || trim($attributes->option_value) === ""
                           || trim($attributes->option_image) === "") {
                            $errors[] = "Kindly check for missing data under attributes sheet";
                        }
                        if(!is_numeric($attributes->option_price)) {
                            $errors[] = "Kindly check for invalid option price under attributes sheet";                            
                        }
                        if(count($errors) > 0 ) {
                            return ["dataNotFound" => $errors];
                        }
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
                            if(strtolower(str_replace("assets/product/", "", $images->product_image_path)) === $attributes->option_image
                               && $images->product_id === $product->id_product){
                                 $attrDetail->product_img_id = $images->id_product_image;
                                 break;
                            }
                        }
                        $attrDetail->save();   
                    }
                }
                $attrHeadArray =[];
                $errors = [];
                foreach($shipmentObject as $shipment) {
                    if($value->number === $shipment->product_number) {
                        $location = LocationLookUp::where("location",$shipment->shipping_location)->first();

                        if(trim($shipment->shipping_location) === "") {
                            $errors[] = "Kindly check for missing data under shipment sheet";
                        }
                        if(!is_numeric($shipment->shipping_price)) {
                            $errors[] = "Kindly check for invalid shipment price under shipment sheet";                            
                        }
                        if(count($errors) > 0 ) {
                            return ["dataNotFound" => $errors];
                        }                        
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
                $resultsIDS["databaseError"] = true;
            }
        }   
        return $resultsIDS;
    }      

}
