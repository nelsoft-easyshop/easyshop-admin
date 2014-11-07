<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use OrderProductTagHistory;

class OrderProductTagHistoryRepository extends AbstractRepository
{    

    /**
     * Create a new order product history entry
     *
     * @param $orderProductId integer
     * @param $status $integer
     * @param $comment string
     * @return Boolean
     */
    public function createOrderProductTagHistory($orderProductId, $tagType, $adminMemberId)
    {
        $orderProductTagHistory = new OrderProductTagHistory();
        $orderProductTagHistory->order_product_id = $orderProductId;
        $orderProductTagHistory->tag_type_id = $tagType;
        $orderProductTagHistory->date_updated = Carbon::now();
        $orderProductTagHistory->admin_member_id = $adminMemberId;

        return $orderProductTagHistory->save();
    }
    


}


