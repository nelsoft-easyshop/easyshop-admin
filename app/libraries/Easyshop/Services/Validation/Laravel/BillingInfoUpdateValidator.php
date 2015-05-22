<?php 

namespace Easyshop\Services\Validation\Laravel;
 
class BillingInfoUpdateValidator extends AbstractLaravelValidator
{
 
   /**
    * Validation for updating BillingInfo
    *
    * @var array
    */
    protected $rules = array(
        'billing_info_id' => 'numeric',
        'account_name' => 'required',
        'account_number' => 'required',
        'bank_id' => 'required|numeric',
        'member_id' => 'required|numeric',
    );

 
}

