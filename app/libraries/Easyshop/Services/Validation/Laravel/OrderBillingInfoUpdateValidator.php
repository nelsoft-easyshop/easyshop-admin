<?php namespace Easyshop\Services\Validation\Laravel;
 
class OrderBillingInfoUpdateValidator extends AbstractLaravelValidator
{
 
   /**
    * Validation for updating OrderBillingInfo
    *
    * @var array
    */
    protected $rules = array(
        'order_billing_info_id' => 'numeric',
        'account_name' => 'required',
        'account_number' => 'required',
        'bank_name' => 'required',
    );

 
}

