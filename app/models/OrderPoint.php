<?php

class OrderPoint extends Eloquent 
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'es_order_points';

    /**
     * The primary key of the table
     *
     */
    protected $primaryKey = 'id_order_points';

    
    public $timestamps = false;

}
