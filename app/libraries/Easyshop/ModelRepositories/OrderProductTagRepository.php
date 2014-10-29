<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use OrderProductTag , OrderProduct; 
use Carbon\Carbon;

class OrderProductTagRepository extends AbstractRepository
{
    /**
     * Get order product tag by seller_id and order_id
     * @param  integer $orderId
     * @param  integer $memberId
     * @return object
     */
    public function getOrderTags($orderId,$memberId)
    {
        return OrderProductTag::whereIn('order_product_id', function($query) use($orderId,$memberId) {
                    $query->select('id_order_product')
                          ->from(with(new OrderProduct)->getTable()) 
                          ->where('order_id', '=', $orderId)
                          ->where('seller_id', '=', $memberId);
                })->get(['es_order_product_tag.*']);
    }

    /**
     * Update order product tag status
     * @param  object  $orderProductTag
     * @param  integer $tagType
     * @return object
     */
    public function updateOrderTags($orderProductTag,$tagType)
    {
        $orderProductTag->tag_type_id = $tagType;
        $orderProductTag->save();
        
        return $orderProductTag;
    }

    /**
     * Insert new data to order_productTag
     * @return [type] [description]
     */
    public function insertOrderProductTag($orderProductId,$sellerId,$tagType,$adminMemberId)
    {
        $orderProductTag = new OrderProductTag();

        $orderProductTag->order_product_id = $orderProductId;
        $orderProductTag->seller_id = $sellerId;
        $orderProductTag->tag_type_id = $tagType;
        $orderProductTag->date_updated = Carbon::now();
        $orderProductTag->admin_member_id = $adminMemberId;
        $orderProductTag->save();

        return $orderProductTag;
    }
}

