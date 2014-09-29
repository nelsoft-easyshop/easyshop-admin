<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use OptionalAttrDetail, OptionalAttrHead, Product, ProductImage, Category, Brand, Style, Member;

class ProductCSVRepository extends AbstractRepository
{    

    /**
     * Scans all of the slugs in csv files if not each one of those already exists in the database
     * @param object $values
     * @return array
     */ 
    public function checkData($values){
        $foo = array();
        foreach($values as $value) {
            $checkIfProductExist = Product::where("slug","=",$value->slug)->first();

            if($checkIfProductExist){
                $foo[] =  $checkIfProductExist->slug;
            }
        }
        if(empty($foo)){
            return $this->insertData($values);
        }
        else {
            return array("existing" => $foo);            
        }
    }

    /**
     * Insert data to the database from the passed csv values
     * @param object $values
     * @return array
     */ 
    public function insertData($values)
    {
        $images = array();
        foreach($values as $value) {

            $category = Category::where("name",$value->category_name)->first();
            $brand = Brand::where("name",$value->brand_name)->first();
            $style = Style::where("name",$value->style)->first();
            $member = Member::where("username",$value->seller)->first();

            $product = new Product;
            $checkIfProductExist = Product::where("slug","=",$value->slug)->first();

            //If only one of the slugs already exists in the database upon the insertion of other product, the action will be cancelled
            if($checkIfProductExist){
                $this->removeErrorData($values);                
                return array("existing" => $checkIfProductExist->slug);
            }                                           
            try{
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

                $attrHead = new OptionalAttrHead;
                $attrHead->product_id = $product->id_product;
                $attrHead->field_name = $value->option_name;
                $attrHead->save();
           
                $productImage = new ProductImage;
                $productImage->product_image_path = "assets/product/".$value->product_image_file;
                $extension = substr($value->product_image_file, strpos($value->product_image_file, ".") + 1);
                $productImage->product_image_type = $extension;
                $productImage->product_id = $product->id_product;
                $productImage->is_primary = "1";
                $productImage->save();

                $attrDetail = new OptionalAttrDetail;
                $attrDetail->head_id = $attrHead->id_optional_attrhead;
                $attrDetail->value_name = $value->option_name;
                $attrDetail->value_price = $value->option_price;
                $attrDetail->product_img_id = $productImage->id_product_image;
                $attrDetail->save();                       

                $images[] = $product->id_product; 
            } 
            catch(\Exception $e) {
                    $this->removeErrorData($values);                    
                    return $images[] = "error";
            }
        }               
        return $images;
    }

    /**
     * Removes data from the current csv files that was detected to have multiple the same product slugs
     * @param object $values
     */ 
    public function removeErrorData($values){
        foreach ($values as $value ) {
            $product = Product::where("slug",$value->slug)->first();
            if($product) {
                $headId = OptionalAttrHead::where('product_id','=',$product->id_product)->first();
                OptionalAttrDetail::where('head_id','=',$headId->id_optional_attrhead)->delete();
                OptionalAttrHead::where('product_id','=',$product->id_product)->delete();
                ProductImage::where('product_id','=',$product->id_product)->delete();
                Product::find($product->id_product)->delete();                
            }
            else {
                continue;
            }

        }
    }    

}   




