<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use Order;

class OrderRepository extends AbstractRepository
{

    
    /**
     * Get order by id
     *
     * @param integer $orderProductId
     * @return Order
     */
    public function getOrderById($orderId)
    {
        return Order::find($orderId);
    }
     
}

