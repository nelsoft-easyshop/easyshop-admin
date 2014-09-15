<?php namespace Easyshop\Services\Validation\Laravel;
 
class RaffleValidator extends AbstractLaravelValidator
{

    /**
    * Validation for updating Registration
    *
    * @var array
    */
    protected $rules = array(
            'raffleName' => 'required|unique:es_raffle,raffle_name', 
            'poolOfWinner' => 'required', 
            'numberOfWinners' => 'required', 


    );


}
