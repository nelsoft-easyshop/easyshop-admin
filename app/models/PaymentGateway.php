<?php

class PaymentGateway extends Eloquent 
{
   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'es_payment_gateway';

   /**
    * The primary key of the table
    *
    */

    protected $primaryKey = 'id';


    /**
     * Timestamp enable flag
     *
     * @var boolean
     */
    public $timestamps = false;
    
}
