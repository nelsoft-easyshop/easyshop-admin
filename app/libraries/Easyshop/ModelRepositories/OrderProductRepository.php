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

   /**
    * Returns all order products that are tied to a certain payment account_name
    *
    * @param string username
    * @param string accountname
    * @param string accountno
    * @return Entity[]
    */
    public function getOrderProductByPaymentAccount($username, $accountname, $accountno){
        $query = OrderProduct::join('es_order_product_billing_info', 'es_order_product.id_order_product', '=', 'es_order_product_billing_info.order_product_id')
                        ->join('es_member as seller','es_order_product.seller_id', '=', 'seller.id_member')
                        ->join('es_order', 'es_order.id_order', '=', 'es_order_product.order_id')
                        ->join('es_member as buyer','es_order.buyer_id', '=', 'buyer.id_member')
                        ->join('es_product','es_order_product.product_id','=','es_product.id_product')
                        ->join('es_order_product_status','es_order_product.status','=','es_order_product_status.id_order_product_status')
                        ->where(function ($query) {
                            $query->where('status', '=', 1)
                                ->orWhere('status', '=', 4);
                        })->where('seller.username', '=', $username)
                        ->where('es_order_product_billing_info.account_name', '=', $accountname)
                        ->where('es_order_product_billing_info.account_number', '=', $accountno);
        return $query->get(['es_order_product.*', 'es_order.invoice_no', 'es_order.buyer_id', 'buyer.username as buyer', 'es_product.name as productname', 'es_order_product_status.name as statusname']);
    }
    
    
    
    
   /**
    * Returns history details of an order product
    *
    * @param integer $orderProductId
    * @return Entity
    */
    public function getOrderProductHistory($orderProductId){

        
        $orderProduct = OrderProduct::join('es_order_product_history', 'es_order_product_history.order_product_id', '=', 'es_order_product.id_order_product')
                                    ->join('es_product', 'es_product.id_product', '=', 'es_order_product_history.product_id')
                                    ->where('es_order_product.id_order_product_id', '=', $orderProductId)
                                    ->get([]);
        
        
        
        return OrderProductHistory::where('order_product_id', '=', $orderProductId);
    }
    
    
    
    
}

