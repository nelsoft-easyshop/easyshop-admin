<?php

class ProductShippingDetail extends Eloquent 
{

   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'es_product_shipping_detail';

   /**
    * The primary key of the table
    *
    */
    protected $primaryKey = 'id_shipping_detail';
    public $timestamps = false;    
}
