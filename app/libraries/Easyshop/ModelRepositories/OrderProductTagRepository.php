<?php namespace Easyshop\ModelRepositories;

use OrderProductTag;
use Carbon\Carbon;

class OrderProductTagRepository extends AbstractRepository
{

    public function insertBuyerTransaction($orderProductId)
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

    public function getBuyersOrdersForTagging($ids)
    {

        return OrderProductTag::leftJoin("es_order_product","es_order_product_tag.order_product_id","="
                                ,"es_order_product.id_order_product")
                                ->join("es_order","es_order_product.id_order_product","=","es_order.id_order")
                                ->join("es_member","es_order.buyer_id","=","es_member.id_member")                                
                                ->leftJoin("es_tag_type","es_order_product_tag.tag_type_id","=","es_tag_type.id_tag_type")
                                ->where("es_order_product_tag.order_product_id",$ids)
                                ->get();

    }

/*        $raffle = new Raffle;
       
        $raffle->raffle_name = $raffleName;
        $raffle->winners = $winners;
        $raffle->members = $members;
        $raffle->prices = $prices;
        return $raffle->save();*/
}
