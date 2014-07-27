<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
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
    *  Get users to be paid. Results are grouped by user and banking details
    *  OrderProduct->status = 1 / Payment has been cleared for transfer to seller 
    *  OrderProduct->status = 4 / Payment has been moved to the seller
    *
    *  @param string $filters['username']
    *  @param string $filters['month']
    *  @param string $filters['year']
    *  @param string $filters['day']
    *  @return Entity[] 
    */
    public function getUserAccountsToPay($filters = array())
    {
        $transactionService = \App::make('TransactionService');
      
        
        if(!empty($filters['year'])  && !empty($filters['month']) && !empty($filters['day'])){
            $dateFrom = $transactionService->getLastPayoutDate($filters['year'].'-'.$filters['month'].'-'.$filters['day']);
            $dateTo = $transactionService->getNextPayoutDate($filters['year'].'-'.$filters['month'].'-'.$filters['day']);
        }else{
            $dateFrom = $transactionService->getLastPayoutDate();
            $dateTo = $transactionService->getNextPayoutDate();
        }

        $query = OrderProduct::join('es_order_product_billing_info', 'es_order_product.id_order_product', '=', 'es_order_product_billing_info.order_product_id')
                            ->join('es_member','es_order_product.seller_id', '=', 'es_member.id_member')
                            ->where(function ($query) {
                                $query->where('status', '=', 1)
                                    ->orWhere('status', '=', 4);
                            })->where('es_order_product.created_at', '>=', $dateFrom)
                            ->where('es_order_product.created_at', '<', $dateTo);
        if(!empty($filters['username'])){
            $query->where('es_member.username', '=', $filters['username']);
        }     
                                        
        $completedOrders = $query->groupBy('es_member.id_member', 'es_order_product_billing_info.bank_name',  'es_order_product_billing_info.account_name',  'es_order_product_billing_info.account_number'  )
                                ->get(['es_member.username', 'es_member.email', 'es_member.contactno', 'es_order_product_billing_info.bank_name', 'es_order_product_billing_info.account_name', 'es_order_product_billing_info.account_number', DB::raw('SUM(es_order_product.net) as net')]);
        
        return $completedOrders;
    }


    
}

