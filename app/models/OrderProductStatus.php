<?php

class OrderProductStatus extends Eloquent
{

    const STATUS_ON_GOING = 0;
    const STATUS_FORWARD_SELLER = 1;
    const STATUS_RETURN_BUYER = 2;
    const STATUS_RETURN_COD = 3;
    const STATUS_PAID_SELLER = 4;
    const STATUS_PAID_BUYER = 5;
    const STATUS_CANCEL = 6;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'es_order_product_status';

    /**
     * The primary key of the table
     *
     */
    protected $primaryKey = 'id_order_product_status';

}
