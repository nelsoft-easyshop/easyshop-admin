<?php namespace Easyshop\ModelRepositories;

use OrderHistory;

class OrderHistoryRepository extends AbstractRepository
{

    /**
     * Create a new order history entry
     *
     * @param $orderId integer
     * @param $status $integer
     * @param $comment string
     * @return OrderHistory
     */
    public function createOrderHistory($orderId, $status, $comment = '')
    {
        $orderHistory = new OrderHistory();
        $orderHistory->order_id = $orderId;
        $orderHistory->comment = $comment;
        $orderHistory->order_status = $status;
        $orderHistory->date_added = date('Y-m-d H:i:s');
        $orderHistory->save();
        
        return $orderHistory;
    }
    

}
