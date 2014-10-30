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
}

