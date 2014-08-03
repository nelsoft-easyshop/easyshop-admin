<?php namespace Easyshop\ModelRepositories;

use Order;

class OrderRepository
{

    
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

