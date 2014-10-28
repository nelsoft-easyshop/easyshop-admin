<?php namespace Easyshop\ModelRepositories;

use OrderProductTag;
use Carbon\Carbon;

class OrderProductTagRepository extends AbstractRepository
{

    public function insertBuyerTransaction($orderProductId)
    {
        $orderProductTag = new OrderProductTag;

        if(!$orderProductTag::where("order_product_id",$orderProductId)->get()) {

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
