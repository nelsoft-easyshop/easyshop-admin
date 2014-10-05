<?php

class ProductItem extends Eloquent 
{

   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'es_product_item';

   /**
    * The primary key of the table
    *
    */
    protected $primaryKey = 'id_product_item';
    public $timestamps = false;    
}
