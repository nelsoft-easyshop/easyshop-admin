<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use Order;
use OrderStatus;

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
    
    /**
     * Returns all valid orders within the specified date range
     *
     * @param Carbon dateFrom
     * @param Carbon dateTo
     * @param integer numberOfRows
     * @return Paginator
     */
    public function getAllValidOrders($dateFrom = null, $dateTo = null,  $stringFilter = null, $numberOfRows = 25)
    {
        $statusDraft = OrderStatus::STATUS_DRAFT;
        $query = Order::where('order_status', '!=', $statusDraft);
        
        if($dateFrom){
            $query->where('dateadded', '>=', $dateFrom);
        }
        
        if($dateTo){
            $query->where('dateadded', '<=', $dateTo);
        }
        
        if($stringFilter){
            $query->where(function ($query) use ($stringFilter){
                $query->where('id_order', 'LIKE', '%'.$stringFilter.'%');
                $query->orWhere('transaction_id', 'LIKE', '%'.$stringFilter.'%');
                $query->orWhere('invoice_no', 'LIKE', '%'.$stringFilter.'%');
            });
        }
        
        $query->paginate($numberOfRows);
        
        return $query->paginate($numberOfRows);
    }
    
    /**
     * Updates the order status
     *
     * @param Order $order
     * @param integer $orderStatus
     * @return boolean
     */
    public function updateOrderStatus($order, $orderStatus)
    {
        $order->order_status = $orderStatus;
        $order->datemodified = date('Y-m-d H:i:s');
        $order->save();
        
        return $order;
    }
     

}

