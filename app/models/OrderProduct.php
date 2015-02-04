<?php

class OrderProduct extends Eloquent 
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'es_order_product';

    /**
     * The primary key of the table
     *
     */
    protected $primaryKey = 'id_order_product';

    /**
     * Disable timestamps
     *
     */
    public $timestamps = false;
    
    /**
     * Relationship with es_member table
     *
     */
    public function seller() 
    {
        return $this->hasOne('Member', 'id_member', 'seller_id');
    }

    /**
     * Relationship with es_order
     *
     */
    public function order() 
    {
        return $this->hasOne('Order', 'id_order', 'order_id');
    }

    /**
     * Relationship with es_order_product_status
     *
     */
    public function orderProductStatus() 
    {
        return $this->hasOne('OrderProductStatus', 'id_order_product_status', 'status');
    }

    /**
     *  Relationship with es_order_product_status
     *
     */
    public function product() 
    {
        return $this->hasOne('Product', 'id_product', 'product_id');
    }
    
    /**
     * Relationship with es_order_billing_info
     *
     */
    public function sellerBillingInfoFromOrderBillingInfo() 
    {
        return $this->hasOne('OrderBillingInfo', 'id_order_billing_info', 'seller_billing_id');
    }
    
    /**
     * Relationship with es_billing_info
     *
     */
    public function sellerBillingInfoFromBillingInfo() 
    {
        return $this->hasOne('BillingInfo', 'id_billing_info', 'seller_billing_id');
    }
    
    
    /**
     * Relationship with es_order_product_history
     *
     */
    public function orderProductHistory()
    {
        return $this->hasMany('OrderProductHistory', 'order_product_id', 'id_order_product');
    }
    
    /**
     * Relationship with es_order_shipping_comment
     *
     */
    public function orderProductComment()
    {
        return $this->hasOne('ProductShippingComment', 'order_product_id', 'id_order_product');
    }


}
