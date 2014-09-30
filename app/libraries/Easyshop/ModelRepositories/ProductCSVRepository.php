<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use LocationLookUp, ProductItem, OptionalAttrDetail, OptionalAttrHead, Product, ProductImage, Category, Brand, Style, Member, ProductShippingDetail, ProductShippingHead;

class ProductCSVRepository extends AbstractRepository
{    


    /**
     * Inserts Data 
     * @param object $productsObject
     * @param object $optionalAttributesObject
     * @param object $shipmentObject
     */ 
    public function insertData($productsObject, $optionalAttributesObject, $shipmentObject)
    {
        $images = array();
        $attrHeadArray = array();
        foreach($productsObject as $value) {

            $category = Category::where("name",$value->category_name)->first();
            $brand = Brand::where("name",$value->brand_name)->first();
            $style = Style::where("name",$value->style)->first();
            $member = Member::where("username",$value->seller)->first();

                                        
            try{
                $product = new Product;
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
              
                $productItem = new ProductItem;
                $productItem->product_id = $product->id_product;
                $productItem->quantity = $value->quantity;
                $productItem->save();

                $productImage = new ProductImage;
                $productImage->product_image_path = "assets/product/".$value->product_image_file;
                $extension = substr($value->product_image_file, strpos($value->product_image_file, ".") + 1);
                $productImage->product_image_type = $extension;
                $productImage->product_id = $product->id_product;
                $productImage->is_primary = "1";
                $productImage->save();  

                foreach($optionalAttributesObject as $attributes){
                    if($value->number === $attributes->product_number) {
                        if(!in_array($attributes->option_name, $attrHeadArray)) {
                            $attrHeadArray[] = $attributes->option_name;
                            $attrHead = new OptionalAttrHead;
                            $attrHead->product_id = $product->id_product;
                            $attrHead->field_name = $attributes->option_name;
                            $attrHead->save();                   
                        }

                        $attrDetail = new OptionalAttrDetail;
                        $attrDetail->head_id = $attrHead->id_optional_attrhead;
                        $attrDetail->value_name = $attributes->option_value;
                        $attrDetail->value_price = $attributes->option_price;
                        $attrDetail->product_img_id = $productImage->id_product_image;
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
                $images[] = $product->id_product; 
            } 
            catch(\Exception $e) {
                return $images[] = "error";
            }
        }   
        return $images;
    }

    /**
     * Removes data from the current csv files that was detected to have multiple the same product slugs
     * @param object $values
     */ 
    public function removeErrorData($productsObject)
    {
        foreach ($productsObject as $value ) {

            $product = Product::where("slug",$value->slug)->first();
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
   

}   




