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

    public function seller() 
    {
        return $this->hasOne('Member', 'id_member', 'seller_id');
    }

    public function order() 
    {
        return $this->hasOne('Order', 'id_order', 'order_id');
    }

    public function orderProductStatus() 
    {
        return $this->hasOne('OrderProductStatus', 'id_order_product_status', 'status');
    }

    public function product() 
    {
        return $this->hasOne('Product', 'id_product', 'product_id');
    }
    
    public function billingInfo() 
    {
        return $this->hasOne('OrderProductBillingInfo', 'order_product_id', 'id_order_product');
    }
    
    public function orderProductHistory()
    {
        return $this->hasMany('OrderProductHistory', 'order_product_id', 'id_order_product');
    }
    
    public function orderProductComment()
    {
        return $this->hasOne('ProductShippingComment', 'order_product_id', 'id_order_product');
    }


}
