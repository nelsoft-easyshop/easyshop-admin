<?php namespace Easyshop\ModelRepositories;

use Raffle;

class RaffleRepository
{

             
    /**
     * Perform the insertion of data under es_admin_member table
     *
     * @param string $username
     * @param string $password
     * @param string $fullname
     *
     * @return bool
     */
    public function addRaffle($raffleName, $winners, $members, $prices)
    {
        $raffle = new Raffle;
       
        $raffle->raffle_name = $raffleName;
        $raffle->winners = $winners;
        $raffle->members = $members;
        $raffle->prices = $prices;
        return $raffle->save();
    }

    /**
     * Returns raffles list
     *
     * @return Entity
     */
    public function getAllRaffle()
    {
        return Raffle::orderBy('raffle_id', 'desc')->get();
    }

    /**
     * Deletes a raffle
     *
     * @param int $raffle_id
     * @return Entity
     */
    public function deleteRaffle($raffle_id)    
    {

        return Raffle::where('raffle_id', '=', $raffle_id)->delete();
    }
    
}

