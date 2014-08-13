<?php namespace Easyshop\Services\Validation\Laravel;
 
use Easyshop\Services\Validation\ValidatorInterface;
 
class BillingInfoUpdateValidator extends AsbtractLaravelValidator{
 
   /**
    * Validation for updating BillingInfo
    *
    * @var array
    */
    protected $rules = array(
        'billing_info_id' => 'required|numeric',
        'account_name' => 'required',
        'account_number' => 'required',
        'bank_id' => 'required|numeric',
        'member_id' => 'required|numeric',
    );

 
}

