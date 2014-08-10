<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use OrderProductHistory;

class OrderProductHistoryRepository extends BaseRepository
{    
    public function createOrderProductHistory($orderProductId, $status, $comment = '')
    {
        $orderProductHistory = new OrderProductHistory();
        $orderProductHistory->order_product_id = $orderProductId;
        $orderProductHistory->comment = $comment;
        $orderProductHistory->order_product_status = $status;

        return $orderProductHistory->save();
    }
    


}


