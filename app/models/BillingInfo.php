<?php

class BillingInfo extends Eloquent
{

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

