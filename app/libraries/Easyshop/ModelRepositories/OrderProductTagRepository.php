<?php namespace Easyshop\ModelRepositories;

use OrderProductTag, TagType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderProductTagRepository extends AbstractRepository
{

    public function insertContactedBuyer($orderProductId)
    {

        if(OrderProductTag::where("order_product_id",$orderProductId)->count() < 1) {
            $orderProductTag = new OrderProductTag;

            $orderProductTag->order_product_id = $orderProductId;
            $orderProductTag->tag_type_id = 1;
            $orderProductTag->date_updated = Carbon::now();
            $orderProductTag->admin_member_id = \Auth::id();

            $orderProductTag->save(); 
        }

            return $orderProductId;
    }

    public function getOrdersTagStatus($ids)
    {

        $tagStatus =  OrderProductTag::join("es_tag_type","es_order_product_tag.tag_type_id","=","es_tag_type.id_tag_type")
                                            ->where("order_product_id",$ids)->first();   

        if($tagStatus) {    
                $dt = Carbon::create(Carbon::parse($tagStatus->date_updated)->year
                                    , Carbon::parse($tagStatus->date_updated)->month
                                    , Carbon::parse($tagStatus->date_updated)->day); 

                if( Carbon::now() > $dt->addDays(2) ){                    
                    $tagStatus->tag_type_id = TagType::REFUND;
                    $tagStatus->save();
                }                
            $status = $tagStatus->tag_description;

        }
        else {
            $status = null;
        }
        return $status;
    }

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
}


