<?php namespace Easyshop\ModelRepositories;

use OrderProductTag, TagType, OrderProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderProductTagRepository extends AbstractRepository
{

    /**
     * Update tags of a particular order_products
     * @param int $orderProductId
     * @param int $tagId
     * @param int $sellerId
     * @return object
     */
    public function updateBuyerTag($orderProductId, $tagId, $sellerId)
    {
        $orderProductTag = OrderProductTag::leftJoin("es_order_product","es_order_product.id_order_product","=","es_order_product_tag.order_product_id")
                            ->where("es_order_product_tag.order_product_id",$orderProductId)
                            ->where("es_order_product_tag.seller_id",$sellerId)
                            ->first();

        if(count($orderProductTag) < 1) {

            $orderProductTag = new OrderProductTag;

            $orderProductTag->order_product_id = $orderProductId;
            $orderProductTag->seller_id = $sellerId;
            $orderProductTag->tag_type_id = $tagId;
            $orderProductTag->date_updated = Carbon::now();
            $orderProductTag->admin_member_id = \Auth::id();
        }
        else {
            $orderProductTag->tag_type_id = $tagId;
            $orderProductTag->seller_id = $sellerId;            
            $orderProductTag->date_updated = Carbon::now();
            $orderProductTag->admin_member_id = \Auth::id();
        }
            return $orderProductTag->save();
    }

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

    /**
     * Check if an order product is tagged
     * @return OBJECT
     */
    public function checkTaggerOrderProduct($orderProductId)
    {
        return OrderProductTag::where("order_product_id",$orderProductId)->count();
    }

}


