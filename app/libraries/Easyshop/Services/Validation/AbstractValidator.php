<?php namespace Easyshop\Services\Validation;
 
abstract class AbstractValidator 
{
    /**
     * Validator
     *
     * @var object
     */
    protected $validator;
    
    /**
     * Data to be validated
     *
     * @var array
     */
    protected $data = [];
    
    /**
     * Validation Rules
     *
     * @var string[]
     */
    protected $rules = [];
    
    /**
     * Validation errors
     *
     * @var string[]
     */
    protected $errors = [];
    
    /**
     * Custom validation messages
     *
     * @var string[]
     */
    protected $messages = array();

   /**
    * Pass the data and the rules to the validator
    *
    * @return boolean
    */
    abstract function passes();
    
    /**
     * Set data to validate
     *
     * @param array $data
     * @return self
     */
    public function with(array $data)
    {
        $this->data = $data;
        return $this;
    }
    
    /**
     * Return errors
     *
     * @return string[]
     */
    public function errors()
    {
        return $this->errors;
    }

    
}

