<?php namespace Easyshop\Services\Order;

use Easyshop\Repositories\Order\OrderInterface;

/**
* OrderService, containing all useful methods for business logic around Order
*/
class OrderService
{

    protected $orderRepository;
    
    /**
    * Loads $orderReposioty with the actual Repository associated with orderInterface
    * 
    * @param orderInterface $orderRepository
    * @return OrderService
    */
    public function __construct(orderInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
    * Method to get order based either on ID
    * 
    * @param mixed $orderId
    * @return string
    */
    public function getOrder($orderId)
    {
        $order = $this->orderRepository->getOrderById($orderId);

        if ($order != null)
        {
            return $order->invoice_no;
        }

        return 'Order not found';
    }
    
}