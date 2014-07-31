<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use OrderProduct;
use Easyshop\Services\TransactionService as TransactionService;

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

