<?php namespace Easyshop\ModelRepositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use OrderProduct, OrderProductStatus, OrderStatus, OrderProductHistory, PaymentMethod, OrderProductTag, TagType;


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
                        ->leftJoin('es_order_billing_info', 'es_order_product.seller_billing_id', '=', 'es_order_billing_info.id_order_billing_info')
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
                    $query->whereRaw("DATEDIFF(?,es_product_shipping_comment.delivery_date) >= 15");
                    $query->setBindings(array_merge($query->getBindings(),array($dateTo)));
                    $query->whereRaw(" DATE_ADD(es_product_shipping_comment.`delivery_date`, INTERVAL 15 DAY) BETWEEN ? AND ?");                    
                    $query->setBindings(array_merge($query->getBindings(),array($dateFrom, $dateTo)));
                }); 
            
            });

        }
        $billingInfoChangeDate = \Config::get('transaction.billingInfoChangeDate');   
        $orderProducts = $query->get(['es_order_product.*', 
                            'es_order.invoice_no', 
                            'es_order.buyer_id as buyer_seller_id', 
                            'buyer.username as buyer_seller_username', 
                            'es_product.name as productname', 
                            'es_order_product_status.name as statusname',
                            'es_order.dateadded',
                            DB::raw('COALESCE(IF( es_order.dateadded < "'.$billingInfoChangeDate.'", es_bank_info.bank_name, es_order_billing_info.bank_name), "") as bank_name'), 
                            DB::raw('COALESCE(IF( es_order.dateadded < "'.$billingInfoChangeDate.'", es_billing_info.bank_account_name, es_order_billing_info.account_name), "") as account_name'), 
                            DB::raw('COALESCE(IF( es_order.dateadded < "'.$billingInfoChangeDate.'", es_billing_info.bank_account_number, es_order_billing_info.account_number), "") as account_number'),
                        ]);
                        
              
 
        $orderProducts = $orderProducts->filter(function($orderProduct) use ($accountname, $accountno, $bankname)
        {
            $isValid = (trim($orderProduct->account_name) === trim($accountname) &&
                        trim($orderProduct->account_number) === trim($accountno) &&
                        trim($orderProduct->bank_name) === trim($bankname));
            return $isValid;
        });
        
        return $orderProducts;
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

    /**
     * Get all transaction grouped by seller
     * @param  integer $seller_id
     * @return Object
     */
    public function getAllSellersTransaction($row = 100,$filter = false,$userData = array())
    {
        $query = OrderProduct::join('es_member','es_order_product.seller_id', '=', 'es_member.id_member'); 
        $query->join('es_order','es_order_product.order_id', '=', 'es_order.id_order');

        $query->leftJoin('es_order_product_tag',function($leftJoin){
            $leftJoin->on('es_order_product_tag.order_product_id', '=', 'es_order_product.id_order_product');
        });

        $query->leftJoin('es_tag_type',function($leftJoin){
            $leftJoin->on('es_order_product_tag.tag_type_id', '=', 'es_tag_type.id_tag_type');
        }); 

        $query->where('es_order.order_status', '=', OrderStatus::STATUS_PAID)
              ->whereIn('es_order.payment_method_id',[PaymentMethod::PAYPAL,PaymentMethod::DRAGONPAY]);


        if($filter){
            if($userData['fullname']){
                $query->where('es_member.fullname', 'LIKE', '%' . $userData['fullname'] . '%');
            }
            if($userData['username']){
                $query->where('es_member.username', 'LIKE', '%' . $userData['username'] . '%');
            }
            if($userData['contactno']){
                $query->where('es_member.contactno', 'LIKE', '%' . $userData['contactno'] . '%');
            }
            if($userData['email']){
                $query->where('es_member.email', 'LIKE', '%' . $userData['email'] . '%');
            }
        }

        if($filter && $userData['tag']){
            $query->where('es_order_product_tag.tag_type_id', '=', $userData['tag']);
        }
        else{
            $query->where(function($query)
                    {
                        $query->orWhere(function($query)
                        {
                            $query->whereNotIn('es_order_product_tag.tag_type_id',[TagType::CONFIRMED,TagType::REFUND,TagType::PAYOUT]);
                        })->orWhere(function($query)
                        {
                            $query->whereNull('es_order_product_tag.tag_type_id');
                        });
                        
                    });
        }

        $query->groupBy('es_member.id_member','es_order_product.order_id')
              ->orderBy('es_order.dateadded','DESC');

        $returnTransaction = $query->paginate($row,[
                                            'es_order.id_order', 
                                            'es_member.username', 
                                            'es_member.id_member', 
                                            'es_member.fullname', 
                                            'es_member.email', 
                                            'es_member.contactno', 
                                            'es_order_product_tag.*',
                                            'es_tag_type.tag_description',
                                            'es_tag_type.tag_color',
                                            DB::raw('COUNT(es_order_product.order_id) as count')
                                        ]);
        
        return $returnTransaction;
    }

    /**
     * Retrieves all buyers with shipping details
     * @return JSON
     */
    public function getBuyersTransactionWithShippingComment($sortBy = null, 
                                                            $sortOrder = null, 
                                                            $filter = null, 
                                                            $filterBy = null)
    {
        $sortBy = $sortBy === NULL ? "es_order.dateadded" : $sortBy;
        $sortOrder = $sortOrder === NULL ? "DESC" : $sortOrder;
        $query = OrderProduct::leftJoin('es_order','es_order_product.order_id', '=', 'es_order.id_order'); 
        $query->leftJoin("es_order_product_tag","es_order_product_tag.order_product_id","=","es_order_product.id_order_product");
        $query->leftJoin("es_tag_type","es_tag_type.id_tag_type","=","es_order_product_tag.tag_type_id");
        $query->leftjoin("es_member","es_order.buyer_id","=","es_member.id_member");
        $query->rightJoin("es_product_shipping_comment","es_product_shipping_comment.order_product_id","=","es_order_product.id_order_product");

        $query->where('es_order.order_status', '!=', OrderStatus::STATUS_VOID)
              ->whereIn('es_order.payment_method_id',[PaymentMethod::PAYPAL,PaymentMethod::DRAGONPAY]);
        if($filter != NULL) {
            if($filter == "username") {
                $query->where('es_member.username', 'LIKE', '%' . $filterBy . '%');
            }
            else if($filter === "email") {
                $query->where('es_member.email', 'LIKE', '%' . $filterBy . '%');
            }
            else if($filter === "contactno") {
                $query->where('es_member.contactno', 'LIKE', '%' . $filterBy . '%');
            }
            else if($filter === "id_order") {
                $query->where('es_order.id_order', 'LIKE', '%' . $filterBy . '%');
            }       
            else if($filter === "CONTACTED") {
                $query->where('es_order_product_tag.tag_type_id', '=', TagType::CONTACTED);
            }     
            else if($filter === "ON-HOLD") {
                $query->where('es_order_product_tag.tag_type_id', '=', TagType::ON_HOLD);
            }      
            else if($filter === "REFUND") {
                $query->where('es_order_product_tag.tag_type_id', '=', TagType::REFUND);
            }                                                           
        }              

        $query->groupBy("es_order_product.seller_id", "es_order_product.order_id")
              ->orderBy($sortBy,$sortOrder);

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
                                            'es_tag_type.tag_color', 
                                            'es_product_shipping_comment.expected_date',
                                            DB::raw('COUNT(es_order_product.order_id) as count')
                                        ]);

        return $returnTransaction;
    }    

    /**
     * Retrieves count of untagged transactions
     * @param bool $isSeller
     * @return Entity Count
     */
    public function countUntagTransaction($isSeller = TRUE)
    {
        if($isSeller) {
            $query = OrderProduct::join('es_member','es_order_product.seller_id', '=', 'es_member.id_member'); 
            $query->join('es_order','es_order_product.order_id', '=', 'es_order.id_order');            
        }
        else {
            $query = OrderProduct::leftJoin('es_order','es_order_product.order_id', '=', 'es_order.id_order');
            $query->leftjoin("es_member","es_order.buyer_id","=","es_member.id_member");
            $query->rightJoin("es_product_shipping_comment","es_product_shipping_comment.order_product_id","=","es_order_product.id_order_product");
        }

        $query->leftJoin('es_order_product_tag',function($leftJoin){
            $leftJoin->on('es_order_product_tag.order_product_id', '=', 'es_order_product.id_order_product');
        });

        $query->leftJoin('es_tag_type',function($leftJoin){
            $leftJoin->on('es_order_product_tag.tag_type_id', '=', 'es_tag_type.id_tag_type');
        }); 

        $query->where('es_order.order_status', '=', OrderStatus::STATUS_PAID)
              ->whereIn('es_order.payment_method_id',[PaymentMethod::PAYPAL,PaymentMethod::DRAGONPAY])
              ->whereNull('es_order_product_tag.tag_type_id');

        return $query->get()->count();
    }
}


