<?php namespace Easyshop\Services;


/**
* TransactionService, containing all useful methods for business logic around transactions
*/
class TransactionService
{
    
    private $payOutDates;
    
    public function __construct(){
        $this->payOutDates = array(5,20);
    }
    
   /**
    * Returns the cutoff dates for payment
    *
    * @return integer[]
    */
    public function getPayOutDays(){
        return $this->payOutDates;
    }
    
   /**
    * Returns next pay out date
    *
    * @param dateNow string
    * @param dateFormat string
    * @return string
    */
    
    public function getNextPayoutDate($dateNow = false, $dateFormat = 'Y-m-d'){
        $dateNow = ($dateNow)?$dateNow:date('Y-m-d');
        $currentDay = intval(date('d',strtotime($dateNow)));
        $currentMonth = intval(date('m',strtotime($dateNow)));
        $currentYear = intval(date('Y',strtotime($dateNow)));

        $day = min($this->payOutDates);
        foreach($this->payOutDates as $date){
            if ($currentDay <= $date){
                $day = $date;
                break;
            }            
        }

        $hasExceededLastCutOff = ($currentDay > max($this->payOutDates));
        $month = $currentMonth + (($hasExceededLastCutOff)?1:0);
        $month = ($month > 12)?1:$month;
        $year = $currentYear + ((($currentMonth === 12) && ($hasExceededLastCutOff))?1:0); 

        return date($dateFormat, strtotime($month.'/'.$day.'/'.$year));
    }
    
   /**
    * Returns last pay out date
    *
    * @param dateNow string
    * @param dateFormat string
    * @return string
    */
    
    
    public function getLastPayoutDate($dateNow = false, $dateFormat = 'Y-m-d'){
        $dateNow = ($dateNow)?$dateNow:date('Y-m-d');
        $currentDay = intval(date('d',strtotime($dateNow)));
        $currentMonth = intval(date('m',strtotime($dateNow)));
        $currentYear = intval(date('Y',strtotime($dateNow)));
        
        $day = max($this->payOutDates);
        foreach($this->payOutDates as $date){
            if ($currentDay > $date){
                $day = $date;
            }            
        }
        
        $hasExceededFirstCutOff = ($currentDay > min($this->payOutDates));
        $month = $currentMonth - ((!$hasExceededFirstCutOff)?1:0);
        $month = ($month < 1)?12:$month;
        $year = $currentYear - ((($currentMonth === 1) && (!$hasExceededFirstCutOff))?1:0  ); 

        return date($dateFormat, strtotime($month.'/'.$day.'/'.$year));
    
    }
    

}