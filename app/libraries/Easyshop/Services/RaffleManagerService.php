<?php namespace Easyshop\Services;

class RaffleManagerService
{

    /**
     * Gets the data from the excel file
     *
     * @param array $data
     * @return array
     */
    public function getPossibleWinners(&$data)
    {
        foreach($data as $datas => $values) {
            foreach($values as $value) {
                $possibleWinnerArr[] =  $value;
            } 
        }
        return $possibleWinnerArr;
    }

    /**
     * Produces unique numbers from the indicated numberofwinners
     *
     * @param array $possibleWinnerArr
     * @param int $userDataCount
     * @param numberOfWinners
     * @return array
     */
    public function getUniqueIndexes(&$possibleWinnerArr, $userDataCount, $numberOfWinners) {
        foreach ($possibleWinnerArr as $members) {
            $uniques = range(0, $userDataCount - 1);
            shuffle($uniques);
            $uniques = array_slice($uniques, 0, $numberOfWinners);
        }
        return $uniques;
    }

    /**
     * Produces the winners
     *
     * @param array $possibleWinnerArr
     * @param int $uniques
     *
     * @return array
     */
    public function getWinnerPools($uniques, &$possibleWinnerArr) 
    {
        $winnerPool = array();
        for ($i=0; $i <= count($uniques) - 1; $i++) { 
            $id = $uniques[$i];
            $winnerPool[] = $possibleWinnerArr[$id];
        }
        return $winnerPool;
    }

}
