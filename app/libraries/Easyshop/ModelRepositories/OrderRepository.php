<?php namespace Easyshop\ModelRepositories;

use Order;

class OrderRepository
{

    const STATUS_PAID = 0;
    const STATUS_COMPLETED = 1;
    
   /**
    * Get order by id
    *
    * @param integer $orderProductId
    * @return Entity
    */
    public function getOrderById($orderId)
    {
        return Order::find($orderId);
    }
     
}

