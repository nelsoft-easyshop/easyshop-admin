<?php 

namespace Easyshop\Services\Validation\Laravel;
 
class MemberUpdateValidator extends AbstractLaravelValidator
{
 
   /**
    * Validation for updating BillingInfo
    *
    * @var array
    */
    protected $rules = [
        'contactno' => 'numeric',
    ];

    protected $messages = [
        'contactno.numeric' => 'Invalid Contact Number Format.'
    ];
}
