<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use OptionalAttrDetail, OptionalAttrHead, Product, ProductImage, Category, Brand, Style, Member;

class ProductCSVRepository extends AbstractRepository
{    

    /**
     * Insert data to the database from the passed csv values
     * @param object $values
     * @return array
     */ 
    public function inserData($values)
    {
        $images = array();
        foreach($values as $value) {
            try{
                $category = Category::where("name",$value->category_name)->first();
                $brand = Brand::where("name",$value->brand_name)->first();
                $style = Style::where("name",$value->style)->first();
                $member = Member::where("username",$value->seller)->first();

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
                return $images[] = "error";
            }
        }

        return $images;
    }   

}


