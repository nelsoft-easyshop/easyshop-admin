<?php namespace Easyshop\Services;

class RaffleManagerService
{

    /**
     * Gets the data from the excel file
     *
     * @param array $data
     * @return array
     */
    public function getPossibleWinners($data)
    {
        $values = array_flatten($data);
        foreach($values[1] as $value) {
           $possibleWinnerArr[] = $value[1];
        } 

        return $possibleWinnerArr;
    }

    /**
     * Returns winners
     *
     * @param array $possibleWinnerArr
     * @param int $userDataCount
     * @param numberOfWinners
     * @return array
     */
    public function getWinners($possibleWinnerArr, $userDataCount, $numberOfWinners) {
        foreach ($possibleWinnerArr as $members) {
            $uniques = range(0, $userDataCount - 1);
            shuffle($uniques);
            $uniques = array_slice($uniques, 0, $numberOfWinners);
        }
        foreach ($uniques as $unique => $key) {
            $winnerPool[] = $possibleWinnerArr[$key];
        }
        return $winnerPool;
    }


}
