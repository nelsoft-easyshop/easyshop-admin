<?php

class OrderHistory extends Eloquent 
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'es_order_history';

    /**
     * The primary key of the table
     *
     */
    protected $primaryKey = 'id_order_history';
    
    /**
     * Timestamp enable flag
     *
     * @var boolean
     */
    public $timestamps = false;

}
