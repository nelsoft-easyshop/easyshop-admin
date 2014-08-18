<?php

class Order extends Eloquent 
{
   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'es_order';

   /**
    * The primary key of the table
    *
    */

    protected $primaryKey = 'id_order';


    public function buyer() 
    {
        return $this->hasOne('Member', 'id_member', 'buyer_id');
    }

    public function shippingAddress() 
    {
        return $this->hasOne('Address');
    }

    public function paymentMethod() 
    {
        return $this->hasOne('PaymentMethod');
    }

    public function orderStatus() 
    {
        return $this->hasOne('OrderStatus');
    }


}
