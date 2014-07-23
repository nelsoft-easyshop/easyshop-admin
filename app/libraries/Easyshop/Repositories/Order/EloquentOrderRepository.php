<?php namespace Easyshop\Repositories\Order;

use Illuminate\Database\Eloquent\Model;

class EloquentOrderRepository implements OrderInterface
{
    //Eloquent Order model entity
    protected $orderModel;
    
    
    /**
    * Setting class $Order to the injected model
    * 
    * @param Model $order
    * @return OrderRepository
    */
    public function __construct(Model $order)
    {
        $this->orderModel = $order;
    }
    
    /**
    * Returns the order object associated with the passed id
    * 
    * @param integer $orderId
    * @return Model
    */
    public function getOrderById($orderId)
    {
        return $this->orderModel->find($orderId);
    }

    
    
}