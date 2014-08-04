<?php namespace Easyshop\Services\Validation\Laravel;
 
use Easyshop\Services\Validation\ValidatorInterface;
 
class BillingInfoCreateValidator extends LaravelValidator implements ValidatorInterface {
 
   /**
    * Validation for creating a new BillingInfo
    *
    * @var array
    */
    protected $rules = array(
        'account_name' => 'required',
        'account_no' => 'required',
        'bank_id' => 'required|numeric'
    );

 
}