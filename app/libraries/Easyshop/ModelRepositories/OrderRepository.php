<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use Order;
use OrderStatus;
use PaymentGateway;
use PaymentMethod;

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
     * @param integer orderStatus
     * @param integer paymentMethod
     * @return Paginator
     */
    public function getAllValidOrders($dateFrom = null, $dateTo = null, $stringFilter = null, $orderStatus = null, $paymentMethod = null, $numberOfRows = 25)
    {
        $statusDraft = OrderStatus::STATUS_DRAFT;
        $query = Order::leftJoin('es_payment_method','es_order.payment_method_id','=','es_payment_method.id_payment_method');
        $query->leftJoin('es_member as buyer','es_order.buyer_id','=','buyer.id_member');
        $query->leftJoin('es_order_product','es_order.id_order','=','es_order_product.order_id');
        $query->leftJoin('es_member as seller', 'es_order_product.seller_id', '=', 'seller.id_member');

        if($dateFrom){
            $query->where('es_order.dateadded', '>=', $dateFrom);
        }
        
        if($dateTo){
            $query->where('es_order.dateadded', '<=', $dateTo);
        }
        
        if($stringFilter){
            $query->where(function ($query) use ($stringFilter){
                $query->where('id_order', 'LIKE', '%'.$stringFilter.'%');
                $query->orWhere('transaction_id', 'LIKE', '%'.$stringFilter.'%');
                $query->orWhere('invoice_no', 'LIKE', '%'.$stringFilter.'%');
                $query->orWhereRaw('COALESCE(buyer.store_name, buyer.username) = ?', [$stringFilter]);
                $query->orWhereRaw('COALESCE(seller.store_name, seller.username) = ?', [$stringFilter]);
            });
        }

        if ($orderStatus !== null) {
            $query->where('es_order.order_status', '=', $orderStatus);
        }
        else {
            $query->where('es_order.order_status', '!=', OrderStatus::STATUS_DRAFT);
        }

        if ($paymentMethod !== null) {
            $query->where('es_order.payment_method_id', '=', $paymentMethod);
        }
        $query->groupBy('es_order.id_order');
        $query->orderBy('es_order.dateadded', 'DESC');
        
        $query->select('es_order.*', 'es_payment_method.*');
          
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

    
    /**
     * Generates the data needed for the transaction record
     *
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @param string $stringFilter
     * @return mixed
     */
    public function getTransactionRecord($startDate = null, $endDate = null, $stringFilter = null)
    {
        $record = Order::join('es_member AS buyer', 'buyer.id_member', '=', 'es_order.buyer_id')
            ->join('es_payment_method AS paymentMethod',
                'paymentMethod.id_payment_method', '=', 'es_order.payment_method_id'
            )
            ->join('es_order_status AS orderStatus',
                'orderStatus.order_status', '=', 'es_order.order_status'
            )
            ->join('es_order_product AS orderProduct',
                'orderProduct.order_id', '=', 'es_order.id_order'
            )
            ->join('es_order_product_status AS orderProductStatus',
                'orderProductStatus.id_order_product_status', '=', 'orderProduct.status'
            )
            ->join('es_order_shipping_address AS orderShippingAddress',
                'orderShippingAddress.id_order_shipping_address', '=', 'es_order.shipping_address_id'
            )
            ->join('es_location_lookup as city', 'city.id_location', '=', 'orderShippingAddress.city')
            ->join('es_location_lookup as region', 'region.id_location', '=', 'orderShippingAddress.stateregion')
            ->join('es_location_lookup as country', 'country.id_location', '=', 'orderShippingAddress.country')
            ->join('es_member AS seller', 'seller.id_member', '=', 'orderProduct.seller_id')
            ->join('es_product AS product', 'product.id_product', '=', 'orderProduct.product_id')
            ->leftJoin('es_product_shipping_comment AS productShippingComment',
                'productShippingComment.order_product_id', '=', 'orderProduct.id_order_product'
            );
     

        if($startDate){
            $record->where('es_order.dateadded', '>=', $startDate );
        }
        
        if($endDate){
            $record->where('es_order.dateadded', '<=', $endDate );
        }
        
        if($stringFilter){
            $record->where(function ($record) use ($stringFilter){
                $record->where('es_order.id_order', 'LIKE', '%'.$stringFilter.'%');
                $record->orWhere('es_order.transaction_id', 'LIKE', '%'.$stringFilter.'%');
                $record->orWhere('es_order.invoice_no', 'LIKE', '%'.$stringFilter.'%');
                $record->orWhereRaw('COALESCE(buyer.store_name, buyer.username) = ?', [$stringFilter]);
                $record->orWhereRaw('COALESCE(seller.store_name, seller.username) = ?', [$stringFilter]);
            });

        }

        $record->select(
            'es_order.id_order AS Order_ID',
            'es_order.transaction_id AS Transaction_ID',
            'es_order.invoice_no AS Invoice_number',
            'product.name AS Product',
            'orderProduct.order_quantity AS Quantity',
            'orderProduct.price AS Item_price',
            'orderProduct.handling_fee AS Handling_fee',
            'orderProduct.total AS Total_price',
            'orderStatus.name AS Order_status',
            'paymentMethod.name AS Payment_method',
            'orderProductStatus.name AS Cash_out_status',
            'orderShippingAddress.address AS Shipping_address',
            'city.location AS City',
            'region.location AS Region',
            'country.location AS Country',
            DB::raw('(CASE WHEN (ISNULL(productShippingComment.`comment`)) THEN "Not yet shipped" ELSE "Shipped" END) AS Delivery_status '),
            'buyer.username AS Buyers_username',
            DB::raw('COALESCE(NULLIF(buyer.store_name, ""), buyer.username) AS Buyers_storename'),
            'buyer.fullname AS Buyers_fullname',
            'buyer.contactno AS Buyers_contact_number',
            'buyer.email AS Buyers_email_address',
            'seller.username AS Sellers_username',
            DB::raw('COALESCE(NULLIF(seller.store_name, ""), seller.username) AS Sellers_storename'),
            'seller.fullname AS Sellers_fullname',
            'seller.contactno AS Sellers_contact_number',
            'seller.email AS Sellers_email_address',
            DB::raw('CONCAT("https://easyshop.ph/item/", product.slug) AS URL '),
            'es_order.dateadded AS Date_added'
        );
        $record->get();
        
   
        return $record->get();
    }

    /**
     * Get orderPoints
     *
     * @param integer $orderId
     * @return string
     */
    public function getOrderPoints($orderId)
    {
        $easyPointGateway = PaymentGateway::where('payment_method_id', '=', PaymentMethod::EASYPOINTS)
                                        ->where('order_id', '=', $orderId)
                                        ->first();
        $point = $easyPointGateway ? $easyPointGateway->amount : "0";
        return $point;
    }
    
}

