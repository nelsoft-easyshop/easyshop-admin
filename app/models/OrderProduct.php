<?php

class OrderProduct extends Eloquent {


   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'es_order_product';

   /*
    * The primary key of the table
    *
    */

    protected $primaryKey = 'id_order_product';


    public function seller() {
        return $this->hasOne('Member', 'id_member', 'seller_id');
    }

    public function order() {
        return $this->hasOne('Order');
    }

    public function orderProductStatus() {
        return $this->hasOne('OrderProductStatus');
    }

    public function product() {
        return $this->hasOne('Product');
    }


}
