<?php namespace Easyshop\Services\Validation\Laravel;
 
use Easyshop\Services\Validation\ValidatorInterface;
 
class OrderBillingInfoUpdateValidator extends AbstractLaravelValidator{
 
   /**
    * Validation for updating OrderBillingInfo
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

