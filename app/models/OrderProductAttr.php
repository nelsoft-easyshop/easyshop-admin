<?php

class OrderProductAttr extends Eloquent 
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'es_order_product_attr';

    /**
     * The primary key of the table
     *
     */
    protected $primaryKey = 'id_order_option';

    /**
     * Disable timestamps
     *
     */
    public $timestamps = false;

}
