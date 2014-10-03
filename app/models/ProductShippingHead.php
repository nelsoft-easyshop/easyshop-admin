<?php

class ProductShippingHead extends Eloquent 
{

   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'es_product_shipping_head';

   /**
    * The primary key of the table
    *
    */
    protected $primaryKey = 'id_shipping';
    public $timestamps = false;    
}
