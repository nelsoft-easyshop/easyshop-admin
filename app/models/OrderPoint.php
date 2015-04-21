<?php

class OrderPoint extends Eloquent 
{

    /**
     * Flag if the order point is reverted
     * @var integer
     */
    const REVERTED = 1;
    
    /**
     * Flag if the order point is not reverted
     * @var integer
     */
    const NOT_REVERTED = 0;

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
