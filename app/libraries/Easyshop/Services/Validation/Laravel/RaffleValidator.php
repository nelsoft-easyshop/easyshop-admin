<?php namespace Easyshop\Services\Validation\Laravel;
 
class RaffleValidator extends AbstractLaravelValidator
{

    /**
    * Validation for updating Registration
    *
    * @var array
    */
    protected $rules = array(
            'raffleName' => 'required|unique:es_raffle,raffle_name|min:5|max:40', 
            'poolOfWinner' => 'required', 
            'numberOfWinners' => 'required', 


    );


}