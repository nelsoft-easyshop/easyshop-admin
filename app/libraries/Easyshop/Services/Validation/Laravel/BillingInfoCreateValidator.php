<?php namespace Easyshop\Services\Validation\Laravel;
 
use Easyshop\Services\Validation\ValidatorInterface;
 
class BillingInfoCreateValidator extends AbstractLaravelValidator{
 
   /**
    * Validation for creating a new BillingInfo
    *
    * @var array
    */
    protected $rules = array(
        'account_name' => 'required',
        'account_number' => 'required',
        'bank_id' => 'required|numeric',
        'member_id' => 'required|numeric',
    );

 
}

