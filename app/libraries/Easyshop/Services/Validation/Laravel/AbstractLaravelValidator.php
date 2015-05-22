<?php namespace Easyshop\Services\Validation\Laravel;
 
use Illuminate\Validation\Factory;
use Easyshop\Services\Validation\AbstractValidator;
 
abstract class AbstractLaravelValidator extends AbstractValidator 
{
 
    /**
    * Validator
    *
    * @var Illuminate\Validation\Factory
    */
    protected $validator;

    /**
    * Construct
    *
    * @param Illuminate\Validation\Factory $validator
    */
    public function __construct(Factory $validator)
    {
        $this->validator = $validator;
    }

    /**
    * Pass the data and the rules to the validator
    *
    * @return boolean
    */
    public function passes()
    {
        $validator = $this->validator->make($this->data, $this->rules);

        if( $validator->fails() )
        {
            $this->errors = $validator->messages();
            return false;
        }
        return true;
    }

    
    /**
     * Set rules
     * 
     * @param string[] $rules
     */
    public function setRules(array $rules)
    {
        $this->rules = $rules;
    }

    
    /**
     * Get rules
     * 
     * @return string[]
     */
    public function getRules()
    {
        return $this->rules;
    }

 
}





