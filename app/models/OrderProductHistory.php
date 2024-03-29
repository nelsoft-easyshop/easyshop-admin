<?php

class OrderProductHistory extends Eloquent 
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'es_order_product_history';

    /**
     * The primary key of the table
     *
     */
    protected $primaryKey = 'id_order_product_history';

    
    /**
     * Disable timestamps
     *
     */
    public $timestamps = false;
    
    /**
     * One-to-one Relationship to orderProductStatus table
     *
     */
    public function orderProductStatus() 
    {
        return $this->hasOne('OrderProductStatus', 'id_order_product_status', 'order_product_status');
    }
 
}
