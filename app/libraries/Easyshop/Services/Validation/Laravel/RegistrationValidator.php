<?php namespace Easyshop\Services\Validation\Laravel;
 
class RegistrationValidator extends AbstractLaravelValidator
{

    /**
    * Validation for updating Registration
    *
    * @var array
    */
    protected $rules = array(
            'username' => 'required|unique:es_admin_member,username', 
            'password' => 'required|min:8|alpha_num', 
            'fullname' => 'required', 
    );


}