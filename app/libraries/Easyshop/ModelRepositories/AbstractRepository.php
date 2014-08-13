<?php  namespace Easyshop\ModelRepositories;

abstract class AbstractRepository
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

}

