<?php namespace Easyshop\ModelRepositories;

use OrderProductTag;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

        $query =  OrderProduct::leftJoin("es_order_product","es_order_product_tag.order_product_id","="
                                ,"es_order_product.id_order_product")
                                ->leftJoin("es_tag_type","es_order_product_tag.tag_type_id","=","es_tag_type.id_tag_type")
                                ->join("es_order","es_order_product.order_id","=","es_order.id_order")
                                ->join("es_member","es_order.buyer_id","=","es_member.id_member")
                                ->where("es_order_product_tag.order_product_id",$ids);

        $returnTransaction = $query->get([
                                            'es_order_product_tag.id_order_product_tag', 
                                            'es_order_product_tag.order_product_id', 
                                            'es_order_product_tag.tag_type_id', 
                                            'es_tag_type.tag_description', 
                                            'es_order.id_order', 
                                            'es_member.username', 
                                            'es_member.email', 
                                            'es_member.contactno',
                                             DB::raw('COUNT(es_order_product.order_id) as count')                                            
                                        ]);                                
        return $returnTransaction;

    }

}


