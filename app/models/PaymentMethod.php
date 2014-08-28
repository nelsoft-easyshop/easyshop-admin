<?php

class PaymentMethod extends Eloquent
{

    const PAYPAL = 1;
    const DRAGONPAY = 2;
    const COD = 3;
    const RESERVED = 4;
    const DIRECTBANK = 5;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'es_payment_method';

    /**
     * The primary key of the table
     *
     */
    protected $primaryKey = 'id_payment_method';

}
