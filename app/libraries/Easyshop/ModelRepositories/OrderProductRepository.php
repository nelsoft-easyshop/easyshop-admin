<?php namespace Easyshop\ModelRepositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use OrderProduct, OrderProductStatus, OrderStatus, OrderProductHistory, PaymentMethod, OrderProductTag, TagType, ProductShippingComment;;


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
        $query = OrderProduct::leftjoin('es_product_shipping_comment','es_order_product.id_order_product','=','es_product_shipping_comment.order_product_id')
                                ->where('es_order_product.order_id', '=', $orderId);

        if(intval($sellerId) !== 0){
            $query->where('es_order_product.seller_id','=',$sellerId);
        }

        return $query->get([
                            'es_order_product.*',
                            DB::raw('COALESCE(es_product_shipping_comment.id_shipping_comment,0) as shipping')
                            ]);
    }
    
    /**
     * Returns all order products to be paid that are tied to a certain payment account_name
     *
     * @param integer[] $orderProductIds
     * @return Collection
     */
    public function getOrderProductsToPay($orderProductIds = [])
    {       
        $query = OrderProduct::leftJoin('es_billing_info', 'es_order_product.seller_billing_id', '=', 'es_billing_info.id_billing_info')
                        ->join('es_member as seller','es_order_product.seller_id', '=', 'seller.id_member')
                        ->join('es_order', 'es_order.id_order', '=', 'es_order_product.order_id')
                        ->join('es_member as buyer','es_order.buyer_id', '=', 'buyer.id_member')
                        ->join('es_product','es_order_product.product_id','=','es_product.id_product')
                        ->join('es_order_product_status','es_order_product.status','=','es_order_product_status.id_order_product_status')
                        ->leftJoin('es_bank_info', 'es_billing_info.bank_id', '=',  'es_bank_info.id_bank')
                        ->leftJoin('es_order_billing_info', 'es_order_product.seller_billing_id', '=', 'es_order_billing_info.id_order_billing_info')
                        ->whereIn('es_order_product.id_order_product', $orderProductIds);

        $billingInfoChangeDate = \Config::get('transaction.billingInfoChangeDate');   
        $orderProducts = $query->get(['es_order_product.*', 
                            'es_order.invoice_no', 
                            'es_order.buyer_id as buyer_seller_id', 
                            'buyer.username as buyer_seller_username', 
                            DB::raw('COALESCE(NULLIF(buyer.store_name, ""), buyer.username) as buyer_seller_storename'),
                            'es_product.name as productname', 
                            'es_order_product_status.name as statusname',
                            'es_order.dateadded',
                            DB::raw('COALESCE(IF( es_order.dateadded < "'.$billingInfoChangeDate.'", es_bank_info.bank_name, es_order_billing_info.bank_name), "") as bank_name'), 
                            DB::raw('COALESCE(IF( es_order.dateadded < "'.$billingInfoChangeDate.'", es_billing_info.bank_account_name, es_order_billing_info.account_name), "") as account_name'), 
                            DB::raw('COALESCE(IF( es_order.dateadded < "'.$billingInfoChangeDate.'", es_billing_info.bank_account_number, es_order_billing_info.account_number), "") as account_number'),
                        ]);

        return $orderProducts;
    }
 

    /**
     * Returns all order products to be refunded for a particular buyer
     *
     * @param integer[] $orderProductIds
     * @return Collection
     */
    public function getOrderProductsToRefund($orderProductIds = [])
    {               
        $query = OrderProduct::join('es_order','es_order_product.order_id', '=', 'es_order.id_order');
        $query->join('es_member','es_order.buyer_id', '=', 'es_member.id_member');
        $query->join('es_member as seller','es_order_product.seller_id', '=', 'seller.id_member');
        $query->join('es_order_product_status','es_order_product.status', '=', 'es_order_product_status.id_order_product_status');
        $query->join('es_product','es_order_product.product_id', '=', 'es_product.id_product');
        $query->leftJoin(DB::raw('
            (SELECT 
                * 
            FROM es_billing_info 
            WHERE 
                es_billing_info.is_default = 1 AND 
                es_billing_info.is_delete = 0 
            GROUP BY es_billing_info.member_id) es_billing_info '), function($leftJoin)
        {
            $leftJoin->on('es_billing_info.member_id', '=', 'es_member.id_member');
        });
        $query->leftJoin('es_bank_info', 'es_billing_info.bank_id', '=', 'es_bank_info.id_bank');
        $query->whereIn('es_order_product.id_order_product', $orderProductIds);
        
        $returnedOrders = $query->get(['es_order_product.*', 
                                    'es_order.invoice_no', 
                                    'es_order_product.seller_id as buyer_seller_id',
                                     DB::raw('COALESCE(NULLIF(seller.store_name, ""), seller.username) as buyer_seller_storename'),
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
    public function getAllSellersTransaction($row = 100,
                                             $filter = false,
                                             $userData = [],
                                             $forBuyer = false)
    {
        if(!$forBuyer) {
            $query = OrderProduct::join('es_member','es_order_product.seller_id', '=', 'es_member.id_member'); 
            $query->join('es_order','es_order_product.order_id', '=', 'es_order.id_order');
            $arrayNotInTag = [TagType::CONFIRMED, TagType::REFUND, TagType::PAYOUT];
        }
        else {
            $query = ProductShippingComment::leftJoin("es_order_product", "es_order_product.id_order_product", "=", "es_product_shipping_comment.order_product_id");
            $query->join('es_order','es_order_product.order_id', '=', 'es_order.id_order'); 
            $query->join("es_member","es_order.buyer_id","=","es_member.id_member");
            $arrayNotInTag = [TagType::CONTACTED, TagType::REFUND, TagType::PAYOUT];
        }

        $query->leftJoin('es_order_product_tag',function($leftJoin){
            $leftJoin->on('es_order_product_tag.order_product_id', '=', 'es_order_product.id_order_product');
        });

        $rawSql = '(SELECT 
                        es_order_product.order_id,
                        COUNT(es_order_product.order_id) as count_tagged
                    FROM es_order_product 
                    LEFT JOIN es_order_product_tag on es_order_product.id_order_product = es_order_product_tag.order_product_id
                    WHERE tag_type_id IS NOT NULL
                    AND tag_type_id NOT IN (?,?,?)
                    GROUP BY es_order_product.order_id
                    ) AS count_temp_table';

        $query->leftJoin(DB::raw($rawSql), function( $query ){
            $query->on( 'count_temp_table.order_id', '=', 'es_order_product.order_id' );
        })->setBindings(array_merge($query->getBindings(), $arrayNotInTag));

        $query->where('es_order.order_status', '=', OrderStatus::STATUS_PAID)
              ->where('es_order_product.status', '=', OrderProductStatus::STATUS_ON_GOING)
              ->whereIn('es_order.payment_method_id', [
                    PaymentMethod::PAYPAL,
                    PaymentMethod::DRAGONPAY,
                    PaymentMethod::PESOPAY,
                ]);

        if($filter){
            if($userData['fullname']){
                $query->where('es_member.fullname', 'LIKE', '%' . $userData['fullname'] . '%');
            }
            if($userData['store_name']){
                $query->where('es_member.store_name', 'LIKE', '%' . $userData['store_name'] . '%');
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
            $query->where(function($query) use($arrayNotInTag, $forBuyer) {
                        $query->orWhere(function($query) use($arrayNotInTag){
                            $query->whereNotIn('es_order_product_tag.tag_type_id', $arrayNotInTag);
                        });
                        if(!$forBuyer) {
                            $query->orWhere(function($query){
                                $query->whereNull('es_order_product_tag.tag_type_id');
                            });
                        }
                        
                    });
        }

        $query->groupBy('es_member.id_member','es_order_product.order_id')
              ->orderBy('es_order_product.id_order_product','DESC')
              ->orderBy('es_order.dateadded','DESC');

        $returnTransaction = $query->paginate($row,[
                                            'es_order.id_order', 
                                            DB::raw('COALESCE(NULLIF(es_member.store_name, ""), es_member.username) as store_name'),
                                            'es_member.id_member', 
                                            'es_member.fullname', 
                                            'es_member.email', 
                                            'es_member.contactno', 
                                            'es_order_product_tag.*', 
                                            'es_order.transaction_id',
                                            'es_order.invoice_no',
                                            'es_order.dateadded',
                                            DB::raw('COUNT(es_order_product.order_id) as count'),
                                            DB::raw('COALESCE(count_temp_table.count_tagged,0) as tag_count')
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
        $query = ProductShippingComment::leftJoin("es_order_product", "es_order_product.id_order_product", "=", "es_product_shipping_comment.order_product_id");
        $query->join('es_order','es_order_product.order_id', '=', 'es_order.id_order'); 
        $query->join("es_member","es_order.buyer_id","=","es_member.id_member");
        $query->leftJoin("es_order_product_tag","es_order_product_tag.order_product_id","=","es_order_product.id_order_product");
        $query->leftJoin("es_tag_type","es_tag_type.id_tag_type","=","es_order_product_tag.tag_type_id");
        $query->where('es_order.order_status', '=', OrderStatus::STATUS_PAID);
        $query->whereIn('es_order.payment_method_id',[
            PaymentMethod::PAYPAL,
            PaymentMethod::DRAGONPAY,
            PaymentMethod::PESOPAY,
        ]);
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
            else if($filter === "PAYOUT") {
                $query->where('es_order_product_tag.tag_type_id', '=', TagType::PAYOUT);
            }                                                           
        } 
        $query->whereNull('es_order_product_tag.tag_type_id');        
        $query->orWhere('es_order_product_tag.tag_type_id', '!=', TagType::PAYOUT);                     

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
                                            'es_order.transaction_id',
                                            'es_order.invoice_no',       
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
    public function countUntagTransaction($isSeller = true)
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

        $query->groupBy("es_order_product.seller_id", "es_order_product.order_id");
        $query->where('es_order.order_status', '=', OrderStatus::STATUS_PAID)
              ->whereIn('es_order.payment_method_id',[
                    PaymentMethod::PAYPAL,
                    PaymentMethod::DRAGONPAY,
                    PaymentMethod::PESOPAY,
                ])
              ->whereNull('es_order_product_tag.tag_type_id');

        return $query->get()->count();
    }

    /**
     * Get order product by OrderId where status is on going
     *
     * @param integer $orderId
     * @return OrderProduct[]
     */
    public function getOrderProductBySellerOngoing($orderId, $sellerId, $tagType = "", $forBuyer)
    {
        if(!$forBuyer) {
            $query = OrderProduct::leftjoin('es_product_shipping_comment','es_order_product.id_order_product','=','es_product_shipping_comment.order_product_id');
            $query->leftjoin('es_order_product_tag',"es_order_product.id_order_product","=","es_order_product_tag.order_product_id");
            $query->leftjoin('es_tag_type',"es_order_product_tag.tag_type_id","=","es_tag_type.id_tag_type");
            $query->where('es_order_product.order_id', '=', $orderId);
            $query->where('es_order_product.seller_id','=',$sellerId);
            $arrayNotInTag = [TagType::CONFIRMED, TagType::REFUND, TagType::PAYOUT];
        }
        else {  
            $query = OrderProduct::join('es_product_shipping_comment','es_order_product.id_order_product','=','es_product_shipping_comment.order_product_id');
            $query->leftjoin('es_order_product_tag',"es_order_product.id_order_product","=","es_order_product_tag.order_product_id");
            $query->leftjoin('es_tag_type',"es_order_product_tag.tag_type_id","=","es_tag_type.id_tag_type");
            $query->where('es_order_product.order_id', '=', $orderId);             
            $query->join('es_order','es_order_product.order_id', '=', 'es_order.id_order');
            $query->where("es_order.buyer_id","=",$sellerId);
            $arrayNotInTag = [TagType::CONTACTED, TagType::REFUND, TagType::PAYOUT];
        }
        $query->where('es_order_product.status','=',OrderProductStatus::STATUS_ON_GOING);
       
        if($tagType){
            $query->where('es_order_product_tag.tag_type_id', '=', $tagType);
        }
        else{
            $query->where(function($query) use ($arrayNotInTag, $forBuyer){
                    $query->orWhere(function($query) use ($arrayNotInTag) {
                        $query->whereNotIn('es_order_product_tag.tag_type_id', $arrayNotInTag);
                    });
                    if(!$forBuyer) {
                        $query->orWhere(function($query){
                            $query->whereNull('es_order_product_tag.tag_type_id');
                        });
                    }
                });
        }

        return $query->get([
                    'es_order_product.*',
                    'es_tag_type.tag_description',
                    'es_order_product_tag.date_updated',
                    'es_tag_type.tag_color',
                    DB::raw('COALESCE(es_order_product_tag.tag_type_id,0) as tag_id'),
                    DB::raw('COALESCE(es_product_shipping_comment.id_shipping_comment,0) as shipping')
                ]);
    }
}


