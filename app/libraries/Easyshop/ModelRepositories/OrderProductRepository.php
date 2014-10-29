<?php namespace Easyshop\ModelRepositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use OrderProduct, OrderProductStatus, OrderStatus, OrderProductHistory, PaymentMethod, OrderProductTag;

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
     * Get order product by OrderId
     *
     * @param integer $orderId
     * @return OrderProduct[]
     */
    public function getOrderProductByOrderId($orderId,$sellerId = 0)
    {
        $query = OrderProduct::where('order_id', '=', $orderId);
        if(intval($sellerId) !== 0){
            $query->where('seller_id','=',$sellerId);
        }

        return $query->get();
    }
    
    public function checkOrderIfContact($orderIds)
    {
        return OrderProduct::leftJoin("es_order_product_tag","es_order_product_tag.order_product_id","=","es_order_product.id_order_product")
                            ->join("es_member","es_member.id_member","=","es_order_product.seller_id")
                            ->where('es_order_product.order_id', '=', $orderIds)
                            ->where('es_order_product_tag.tag_type_id', '!=', "")
                            ->first();



    }
    
    /**
     * Returns all order products to be paid that are tied to a certain payment account_name
     *
     * @param string username
     * @param string accountname
     * @param string accountno
     * @param Carbon dateFrom
     * @param Carbon dateTo
     * @return Collection
     */
    public function getOrderProductsToPay($username, $accountname, $accountno, $bankname, $dateFrom = null, $dateTo = null)
    {       

        $query = OrderProduct::leftJoin('es_billing_info', 'es_order_product.seller_billing_id', '=', 'es_billing_info.id_billing_info')
                        ->join('es_member as seller','es_order_product.seller_id', '=', 'seller.id_member')
                        ->join('es_order', 'es_order.id_order', '=', 'es_order_product.order_id')
                        ->join('es_member as buyer','es_order.buyer_id', '=', 'buyer.id_member')
                        ->join('es_product','es_order_product.product_id','=','es_product.id_product')
                        ->join('es_order_product_status','es_order_product.status','=','es_order_product_status.id_order_product_status')
                        ->leftJoin('es_order_product_history', function($join){
                                $join->on('es_order_product.id_order_product', '=', 'es_order_product_history.order_product_id');
                                $join->on('es_order_product_history.order_product_status', '=',  DB::raw(OrderProductStatus::STATUS_FORWARD_SELLER));
                         })->leftJoin('es_product_shipping_comment','es_product_shipping_comment.order_product_id', '=', 'es_order_product.id_order_product')
                        ->leftJoin('es_bank_info', 'es_billing_info.bank_id', '=',  'es_bank_info.id_bank')
                        ->where('seller.username', '=', $username);

        if($dateFrom && $dateTo){
            $dateFrom = $dateFrom->format('Y-m-d H:i:s');
            $dateTo = $dateTo->format('Y-m-d H:i:s');
            
            $query->where(function ($query) use ($dateFrom, $dateTo){
                $query->where(function ($query) use ($dateFrom, $dateTo){
                    $query->where('es_order_product_history.date_added', '>=', $dateFrom);
                    $query->where('es_order_product_history.date_added', '<', $dateTo);
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
            $query->where('es_billing_info.bank_account_name', '=', $accountname);
        }else{
            $query->whereNull('es_billing_info.bank_account_name');
        }
        
        if(trim($accountno) !== ""){
            $query->where('es_billing_info.bank_account_number', '=', $accountno);
        }else{
            $query->whereNull('es_billing_info.bank_account_number');
        }    
        if(trim($bankname) !== ""){
            $query->where('es_bank_info.bank_name', '=', $bankname);
        }else{
            $query->whereNull('es_bank_info.bank_name');
        }    
        
        
        return $query->get(['es_order_product.*', 
                            'es_order.invoice_no', 
                            'es_order.buyer_id as buyer_seller_id', 
                            'buyer.username as buyer_seller_username', 
                            'es_product.name as productname', 
                            'es_order_product_status.name as statusname'
                        ]);

    }
 

    /**
     * Returns all order products to be refunded for a particular buyer
     *
     * @param string username
     * @param Carbon dateFrom
     * @param Carbon dateTo
     * @return Collection
     */
    public function getOrderProductsToRefund($username = null, $dateFrom = null, $dateTo = null)
    {               
        $query = OrderProduct::join('es_order','es_order_product.order_id', '=', 'es_order.id_order');
        $query->join('es_member','es_order.buyer_id', '=', 'es_member.id_member');
        $query->join('es_member as seller','es_order_product.seller_id', '=', 'seller.id_member');
        $query->join('es_order_product_status','es_order_product.status', '=', 'es_order_product_status.id_order_product_status');
        $query->join('es_product','es_order_product.product_id', '=', 'es_product.id_product');
        $query->leftJoin('es_billing_info',function($leftJoin){
            $leftJoin->on('es_billing_info.member_id', '=', 'es_member.id_member');
            $leftJoin->on('es_billing_info.is_default', '=',  DB::raw('1'));
        });
        
        $query->leftJoin('es_bank_info', 'es_billing_info.bank_id', '=', 'es_bank_info.id_bank');
        
        $query->join('es_order_product_history', function($join){
            $join->on('es_order_product.id_order_product', '=', 'es_order_product_history.order_product_id');
            $join->on('es_order_product_history.order_product_status', '=',  DB::raw(OrderProductStatus::STATUS_RETURN_BUYER));
        });
        
        if($dateFrom && $dateTo){
            $dateFrom = $dateFrom->format('Y-m-d H:i:s');
            $dateTo = $dateTo->format('Y-m-d H:i:s');
        
            $query->where(function ($query) use ($dateFrom, $dateTo){
                $query->where('es_order_product_history.date_added', '>=', $dateFrom);
                $query->where('es_order_product_history.date_added', '<', $dateTo);
            });
        }
        
        if($username !== null){
            $query->where('es_member.username', '=', $username);
        }     
        
        $returnedOrders = $query->get(['es_order_product.*', 
                                    'es_order.invoice_no', 
                                    'es_order_product.seller_id as buyer_seller_id',
                                    'seller.username as buyer_seller_username' , 
                                    'es_product.name as productname', 
                                    'es_order_product_status.name as statusname']);
        
        return $returnedOrders;
    }
 
 
    /**
     * Updates the order product status
     *
     * @param OrderProduct $orderProduct
     * @param integer $status
     * @return Boolean
     */
    public function updateOrderProductStatus($orderProduct, $status)
    {
        $orderProduct->status = $status;
        $orderProduct->save();
        
        return $orderProduct;
    }
    
    /**
     * Updates the buyer billing id
     *
     * @param integer $orderProductId
     * @param inetger $buyerBillingId
     * @return Boolean
     */
    public function updateOrderProductBuyerBillingId($orderProductId, $buyerBillingId)
    {
        $orderProduct = OrderProduct::find($orderProductId);
        $orderProduct->buyer_billing_id = $buyerBillingId;        
        return $orderProduct->save();
    }

    public function getAllSellersTransaction($seller_id = 0)
    {
        $query = OrderProduct::join('es_member','es_order_product.seller_id', '=', 'es_member.id_member'); 
        $query->join('es_order','es_order_product.order_id', '=', 'es_order.id_order');
        $query->where('es_order.order_status', '!=', OrderStatus::STATUS_VOID)
              ->whereIn('es_order.payment_method_id',[PaymentMethod::PAYPAL,PaymentMethod::DRAGONPAY])
              ->groupBy('es_member.id_member','es_order_product.order_id')
              ->orderBy('es_order.dateadded','DESC');

        $returnTransaction = $query->get([
                                            'es_order.id_order', 
                                            'es_member.username', 
                                            'es_member.id_member', 
                                            'es_member.email', 
                                            'es_member.contactno', 
                                            DB::raw('COUNT(es_order_product.order_id) as count')
                                        ]);
        
        return $returnTransaction;
    }

    public function getBuyersTransactionWithShippingComment()
    {
        $query = OrderProduct::leftJoin('es_order','es_order_product.order_id', '=', 'es_order.id_order'); 
        $query->leftJoin("es_order_product_tag","es_order_product_tag.order_product_id","=","es_order_product.id_order_product");
        $query->leftJoin("es_tag_type","es_tag_type.id_tag_type","=","es_order_product_tag.tag_type_id");
        $query->leftjoin("es_member","es_order.buyer_id","=","es_member.id_member");
        $query->rightJoin("es_product_shipping_comment","es_product_shipping_comment.order_product_id","=","es_order_product.id_order_product");
        $query->where('es_order.order_status', '!=', OrderStatus::STATUS_VOID)
              ->whereIn('es_order.payment_method_id',[PaymentMethod::PAYPAL,PaymentMethod::DRAGONPAY])
              ->groupBy("es_order_product.seller_id", "es_order_product.order_id")
              ->orderBy('es_order.dateadded','DESC');

        $returnTransaction =  $query->get([
                                            'es_order.id_order', 
                                            'es_order_product.id_order_product', 
                                            'es_member.username', 
                                            'es_member.id_member', 
                                            'es_order_product.seller_id',
                                            'es_member.email', 
                                            'es_member.contactno', 
                                            'es_order_product_tag.tag_type_id', 
                                            'es_tag_type.tag_description', 
                                            'es_product_shipping_comment.expected_date',
                                            DB::raw('COUNT(es_order_product.order_id) as count')
                                        ]);

        return $returnTransaction;
    }    
}

