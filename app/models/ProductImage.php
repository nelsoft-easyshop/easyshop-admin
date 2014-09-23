<?php

class ProductImage extends Eloquent {

   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'es_product_image';

   /*
    * The primary key of the table
    *
    */

    protected $primaryKey = 'id_product_image';
    public $timestamps = false;    


}
