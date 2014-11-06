<?php

class OrderProductTagHistory extends Eloquent 
{

   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'es_order_product_tag_history';

   /**
    * The primary key of the table
    *
    */
    protected $primaryKey = 'id_order_product_tag_history';
    public $timestamps = false;



}
