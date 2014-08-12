<?php

class PaymentMethod extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'es_payment_method';

    /*
     * The primary key of the table
     *
     */
    protected $primaryKey = 'id_payment_method';

}
