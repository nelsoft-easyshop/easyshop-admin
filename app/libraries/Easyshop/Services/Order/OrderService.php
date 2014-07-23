<?php namespace Easyshop\Services\Order;

use Easyshop\Repositories\Order\OrderInterface;

/**
* OrderService, containing all useful methods for business logic around Order
*/
class OrderService
{
    // Containing our pokemonRepository to make all our database calls to
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

        // If Eloquent Object returned (rather than null) return the name of the pokemon
        if ($order != null)
        {
            return $order->invoice_no;
        }

        // If nothing found, return this simple string
        return 'Order not found';
    }
    
    
    
    
}