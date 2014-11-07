<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use ProductShippingComment;

class ProductShippingCommentRepository extends AbstractRepository
{
    /**
     * Return product shipping details of the product
     * @param  integer $orderProductId [description]
     * @return object
     */
    public function getShippingCommentByOrderProductId($orderProductId)
    {
        return ProductShippingComment::where('order_product_id', '=', $orderProductId)->get();
    }

    /**
     * Add shipping comment for order product
     */
    public function addShippingComment($orderProductId
                                        ,$courier
                                        ,$tracking
                                        ,$comment
                                        ,$memberId
                                        ,$expectedDate
                                        ,$deliveryDate
                                        ,$modifiedDate)
    {
        $productShippingComment = new ProductShippingComment();

        $productShippingComment->order_product_id = $orderProductId;
        $productShippingComment->courier = $courier;
        $productShippingComment->tracking_num = $tracking;
        $productShippingComment->comment = $comment;
        $productShippingComment->member_id = $memberId;
        $productShippingComment->expected_date = $expectedDate;
        $productShippingComment->delivery_date = $deliveryDate;
        $productShippingComment->datemodified = $modifiedDate;
        $productShippingComment->save();

        return $productShippingComment;
    }
}

