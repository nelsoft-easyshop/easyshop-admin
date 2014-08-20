<?php namespace Easyshop\Services\Validation\Laravel;
 
class OrderBillingInfoCreateValidator extends AbstractLaravelValidator
{
 
   /**
    * Validation for create OrderBillingInfo
    *
    * @var array
    */
    protected $rules = array(
        'account_name' => 'required',
        'account_number' => 'required',
        'bank_name' => 'required',
    );

 
}

