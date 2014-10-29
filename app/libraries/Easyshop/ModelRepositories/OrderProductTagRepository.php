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


