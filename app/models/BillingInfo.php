<?php

use Magniloquent\Magniloquent\Magniloquent;

class BillingInfo extends Magniloquent
{

    /**
     * Validation rules
     *
     */
    public static $rules = array(
        "save" => array(
            'bank_account_name' => 'required',
            'bank_account_number' => 'required',
            'bank_id' => 'required|numeric',
            'member_id' => 'required|numeric',
        ),
        "create" => array(),
        "update" => array(
            'id_billing_info' => 'required|numeric',
        )
    );
    

   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'es_billing_info';

   /**
    * The primary key of the table
    *
    */
    protected $primaryKey = 'id_billing_info';

    
    public function member() 
    {
        return $this->belongsTo('Member', 'member_id', 'id_member');
    }
    
    public function bankInfo() 
    {
        return $this->hasOne('BankInfo', 'id_bank', 'bank_id');
    }


}

