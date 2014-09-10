<?php namespace Easyshop\Services\Validation\Laravel;
 
class RaffleValidator extends AbstractLaravelValidator
{

    /**
    * Validation for updating Registration
    *
    * @var array
    */
    protected $rules = array(
            'raffleName' => 'required', 
            'poolOfWinner' => 'required', 
            'numberOfWinners' => 'required', 
            'listOfPrices' => 'required', 

    );


}
