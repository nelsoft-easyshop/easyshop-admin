<?php namespace Easyshop\ModelRepositories;

use OrderProduct;

class OrderProductRepository
{
   /**
    * Get order product by id
    *
    * @param integer $orderProductId
    * @return Entity
    */
    public function getOrderProductById($orderProductId)
    {
        return OrderProduct::find($orderProductId);
    }
    
    
   /**
    *  Get all completed orders
    *  OrderProduct->status = 1 / Payment has been cleared for transfer to seller 
    *  OrderProduct->status = 4 / Payment has been moved to the seller
    *
    *  @return Entity[] 
    */
    public function getCompletedOrders()
    {
        $completedOrders = OrderProduct::where(function ($query) {
            $query->where('status', '=', 1)
                  ->orWhere('status', '=', 4);
        })->get();
        
        return $completedOrders;

        
    }
    
}

