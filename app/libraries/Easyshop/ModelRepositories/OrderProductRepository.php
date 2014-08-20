<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use OrderProduct, OrderProductStatus, OrderStatus, OrderProductHistory;

class OrderProductRepository extends AbstractRepository
{    

    /**
     * Get order product by id
     *
     * @param integer $orderProductId
     * @return OrderProduct
     */
    public function getOrderProductById($orderProductId)
    {
        return OrderProduct::find($orderProductId);
    }

    /**
     * Get order products by Id. Accepts integer array.
     *
     * @param integer[] $orderProductIds
     * @return OrderProduct[]
     */
    public function getManyOrderProductById($orderProductIds)
    {
        $questionmarks = str_repeat("?,", count($orderProductIds)-1) . "?";
        $query = OrderProduct::whereRaw("id_order_product IN (".$questionmarks.")");
        $query->setBindings(array_merge($query->getBindings(),$orderProductIds));
        
        return $query->get();
    }
    
    /**
     * Returns all order products that are tied to a certain payment account_name
     *
     * @param string username
     * @param string accountname
     * @param string accountno
     * @param Carbon dateFrom
     * @param Carbon dateTo
     * @return Collection
     */
    public function getOrderProductByPaymentAccount($username, $accountname, $accountno, $bankname, $dateFrom = null, $dateTo = null)
    {       

        $query = OrderProduct::leftJoin('es_order_billing_info', 'es_order_product.seller_billing_id', '=', 'es_order_billing_info.id_order_billing_info')
                        ->join('es_member as seller','es_order_product.seller_id', '=', 'seller.id_member')
                        ->join('es_order', 'es_order.id_order', '=', 'es_order_product.order_id')
                        ->join('es_member as buyer','es_order.buyer_id', '=', 'buyer.id_member')
                        ->join('es_product','es_order_product.product_id','=','es_product.id_product')
                        ->join('es_order_product_status','es_order_product.status','=','es_order_product_status.id_order_product_status')
                        ->join('es_order_product_history', function($join){
                                $join->on('es_order_product.id_order_product', '=', 'es_order_product_history.order_product_id');
                                $join->on('es_order_product_history.order_product_status', '=',  DB::raw(OrderProductStatus::STATUS_FORWARD_SELLER));
                         })->leftJoin('es_product_shipping_comment','es_product_shipping_comment.order_product_id', '=', 'es_order_product.id_order_product')
                        ->where('seller.username', '=', $username);

        if($dateFrom && $dateTo){
            $dateFrom = $dateFrom->format('Y-m-d');
            $dateTo = $dateTo->format('Y-m-d');
            
            $query->where(function ($query) use ($dateFrom, $dateTo){
                $query->where(function ($query) use ($dateFrom, $dateTo){
                    $query->where('es_order_product_history.created_at', '>=', $dateFrom);
                    $query->where('es_order_product_history.created_at', '<', $dateTo);
                });
                
                $query->orWhere(function ($query) use ($dateFrom, $dateTo) {
                    $query->where(function ($query) {
                                    $query->where('es_order.order_status', '=', OrderStatus::STATUS_PAID)
                                        ->orWhere('es_order.order_status', '=',  OrderStatus::STATUS_COMPLETED);
                                });
                    $query->where('es_order_product.status', '=', OrderProductStatus::STATUS_ON_GOING);
                    $query->where('es_order_product.is_reject', '=', '0');
                    $query->whereNotNull('es_product_shipping_comment.id_shipping_comment');
                    $query->where(DB::raw("DATEDIFF(?,es_product_shipping_comment.delivery_date) >= 15"));
                    $query->setBindings(array_merge($query->getBindings(),array($dateTo)));
                    $query->where(DB::raw(" DATE_ADD(es_product_shipping_comment.`delivery_date`, INTERVAL 15 DAY) BETWEEN ? AND ?"));
                    $query->setBindings(array_merge($query->getBindings(),array($dateFrom, $dateTo)));
                }); 
            
            });

        }

        if(trim($accountname) !== ""){
            $query->where('es_order_billing_info.account_name', '=', $accountname);
        }else{
            $query->whereNull('es_order_billing_info.account_name');
        }
        
        if(trim($accountno) !== ""){
            $query->where('es_order_billing_info.account_number', '=', $accountno);
        }else{
            $query->whereNull('es_order_billing_info.account_number');
        }    
        if(trim($bankname) !== ""){
            $query->where('es_order_billing_info.bank_name', '=', $bankname);
        }else{
            $query->whereNull('es_order_billing_info.bank_name');
        }    
        
        
        return $query->get(['es_order_product.*', 'es_order.invoice_no', 'es_order.buyer_id', 'buyer.username as buyer', 'es_product.name as productname', 'es_order_product_status.name as statusname']);

    }
 
    /**
     * Updates the order product status
     *
     * @param integer $orderProductId
     * @param inetger $status
     * @return Boolean
     */
    public function updateOrderProductStatus($orderProductId,$status)
    {
        $orderProduct = OrderProduct::find($orderProductId);
        $orderProduct->status = $status;        
        return $orderProduct->save();
    }

}
