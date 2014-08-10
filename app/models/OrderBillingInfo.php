<?php

use Magniloquent\Magniloquent\Magniloquent;

class OrderBillingInfo extends Magniloquent 
{

    /**
     * Validation rules
     *
     */
    public static $rules = array(
        "save" => array(),
        "create" => array(
            'account_name' => 'required',
            'account_number' => 'required',
            'bank_name' => 'required',
        ),
        "update" => array(
            'id_order_billing_info' => 'required|numeric',
        )
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'es_order_billing_info';

    /**
     * The primary key of the table
     *
     */
    protected $primaryKey = 'id_order_billing_info';

    /**
     * One to one relationship with es_bank table
     *
     */
    public function bankInfo() 
    {
        return $this->hasOne('BankInfo', 'id_bank_info', 'bank_id');
    }


}
