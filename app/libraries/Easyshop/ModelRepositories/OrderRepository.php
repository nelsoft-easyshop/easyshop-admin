<?php namespace Easyshop\ModelRepositories;

use Order;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
   /**
    * Get order by id
    *
    * @param integer $orderId
    * @return Entity
    */
    public function getOrderById($orderId)
    {
        return Order::find($orderId);
    }

    public function getTransactionRecord($userData=false)
    {
        $record = Order::join('es_member AS buyer', 'buyer.id_member', '=', 'es_order.buyer_id')
            ->join('es_payment_method AS paymentMethod', 'paymentMethod.id_payment_method', '=', 'es_order.payment_method_id')
            ->join('es_order_status AS orderStatus', 'orderStatus.id_order_status', '=', 'es_order.order_status')
            ->join('es_order_product AS orderProduct', 'orderProduct.order_id', '=', 'es_order.id_order')
            ->join('es_order_product_status AS orderProductStatus', 'orderProductStatus.id_order_product_status', '=', 'orderProduct.status')
            ->join('es_order_shipping_address AS orderShippingAddress', 'orderShippingAddress.id_order_shipping_address', '=', 'es_order.shipping_address_id')
            ->join('es_location_lookup as city', 'city.id_location', '=', 'orderShippingAddress.city')
            ->join('es_location_lookup as region', 'region.id_location', '=', 'orderShippingAddress.stateregion')
            ->join('es_location_lookup as country', 'country.id_location', '=', 'orderShippingAddress.country')
            ->join('es_member AS seller', 'seller.id_member', '=', 'orderProduct.seller_id')
            ->join('es_product AS product', 'product.id_product', '=', 'orderProduct.product_id')
            ->leftJoin('es_product_shipping_comment AS productShippingComment', 'productShippingComment.order_product_id', '=', 'orderProduct.id_order_product');

        if( ($userData['startdate']) && ($userData['enddate']) ){
            $record->where('es_order.created_at', '>=', str_replace('/', '-', $userData['startdate']) . ' 00:00:00' )
                ->where('es_order.created_at', '<=', str_replace('/', '-', $userData['enddate']) . ' 23:59:59', 'AND');
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
                'buyer.fullname AS Buyers_fullname',
                'buyer.contactno AS Buyers_contact_number',
                'buyer.email AS Buyers_email_address',
                'seller.username AS Sellers_username',
                'seller.fullname AS Sellers_fullname',
                'seller.contactno AS Sellers_contact_number',
                'seller.email AS Sellers_email_address',
                DB::raw('CONCAT("https://easyshop.ph/item/", product.slug) AS URL '),
                'es_order.created_at AS Date_added'
            );

        return $record->get();
    }
}
