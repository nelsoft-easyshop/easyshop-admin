<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use OrderProductHistory;

class OrderProductHistoryRepository extends AbstractRepository
{    

    /**
     * Create a new order product history entry
     *
     * @param $orderProductId integer
     * @param $status $integer
     * @param $comment string
     * @return Boolean
     */
    public function createOrderProductHistory($orderProductId, $status, $comment = '')
    {
        $orderProductHistory = new OrderProductHistory();
        $orderProductHistory->order_product_id = $orderProductId;
        $orderProductHistory->comment = $comment;
        $orderProductHistory->order_product_status = $status;
        $orderProductHistory->date_added = date('Y-m-d H:i:s');

        return $orderProductHistory->save();
    }
    


}


