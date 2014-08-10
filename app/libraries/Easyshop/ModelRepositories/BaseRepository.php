<?php  namespace Easyshop\ModelRepositories;

class BaseRepository
{    

    /**
     * ID of last modified/created db entry
     *
     * @var integer
     */
    public $currentId;
    
    
    /**
     * Error for Model Validation
     *
     * @var MessageBag[]
     */
    public $errors;
    
    
    /**
     * Returns ID of last modified database row
     *
     * @return integer
     */
    public function getLastId()
    {
        return $this->currentId;
    }
    
    /**
     * Returns the errors of the last CRUD operation
     *
     * @return MessageBag[]
     */
    public function getErrors()
    {
        return $this->errors;
    }

}

