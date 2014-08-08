<?php namespace Easyshop\Services\Validation\Laravel;
 
use Easyshop\Services\Validation\ValidatorInterface;
 
class OrderProductBillingInfoUpdateValidator extends LaravelValidator implements ValidatorInterface {
 
   /**
    * Validation for updating OrderProductBillingInfo
    *
    * @var array
    */
    protected $rules = array(
        'order_billing_info_id' => 'required|numeric',
        'account_name' => 'required',
        'account_number' => 'required',
        'bank_name' => 'required',
    );

 
}

