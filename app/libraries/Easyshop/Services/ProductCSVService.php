<?php namespace Easyshop\Services;

use Product;
use ProductImage;
use ProductItem; 
use OptionalAttrDetail;
use OptionalAttrHead;
use ProductShippingDetail;
use ProductShippingHead;


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
