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

}

