<?php

class OrderStatus extends Eloquent 
{

    const STATUS_PAID = 0;
    const STATUS_COMPLETED = 1;
    const STATUS_VOID = 2;
    const STATUS_DRAFT = 99;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'es_order_status';

    /**
     * The primary key of the table
     *
     */
    protected $primaryKey = 'order_status';



}
