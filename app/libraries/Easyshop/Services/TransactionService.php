<?php namespace Easyshop\Services;

use Config;
use Carbon\Carbon;

/**
 * TransactionService, containing all useful methods for business logic around transactions
 */
class TransactionService
{
    
    private $payOutConfig;
    
    public function __construct()
    {
        $this->payOutConfig = Config::get('transaction.payOut');
    }
    
   /**
    * Returns the cutoff dates for payment
    *
    * @return integer[]
    */
    public function getPayOutDays()
    {
        $dates = array();
        foreach($this->payOutConfig as $config){
            array_push($dates, $config['day']);
        }
        return $dates;
        
    }
    
   /**
    * Returns next pay out date
    *
    * @param Carbon $dateNow
    * @return Carbon
    */
    public function getNextPayoutDate($dateNow = "")
    {

        $dateNow = ($dateNow !== "") ? $dateNow : Carbon::now();
        $currentDay = intval($dateNow->format('d'));
        $currentMonth = intval($dateNow->format('m'));
        $currentYear = intval($dateNow->format('Y'));

        $payOutDays = $this->getPayOutDays();
        $day = min($payOutDays);
        
        foreach($payOutDays as $payoutday){
            if ($currentDay <= $payoutday){
                $day = $payoutday;
                break;
            }            
        }

        $hasExceededLastCutOff = ($currentDay > max($payOutDays));
        $month = $currentMonth + ($hasExceededLastCutOff ? 1 : 0);
        $month = ($month > 12) ? 1 : $month;
        $year = $currentYear + (($currentMonth === 12 && $hasExceededLastCutOff) ? 1 : 0); 

        return Carbon::createFromFormat('Y-m-d', $year.'-'.$month.'-'.$day);
    }
    
    
   /**
    * Returns next pay out date
    *
    * @param Carbon $dateNow
    * @return Carbon
    */
    public function getLastPayoutDate($dateNow = "")
    {
        $dateNow = ($dateNow !== "")? $dateNow : Carbon::now();
        $currentDay = intval($dateNow->format('d'));
        $currentMonth = intval($dateNow->format('m'));
        $currentYear = intval($dateNow->format('Y'));

        $payOutDays = $this->getPayOutDays();
        $day = max($payOutDays);
        
        foreach($payOutDays as $payoutday){
            if ($currentDay > $payoutday){
                $day = $payoutday;
            }            
        }
        
        $hasExceededFirstCutOff = ($currentDay > min($payOutDays));
        $month = $currentMonth - (!$hasExceededFirstCutOff ? 1 : 0);
        $month = ($month < 1) ? 12 : $month;
        $year = $currentYear - (($currentMonth === 1 && !$hasExceededFirstCutOff)?1:0  ); 
        
        return Carbon::createFromFormat('Y-m-d', $year.'-'.$month.'-'.$day);
    }
    
    
   /**
    * Returns start date of the specified pay-out range
    *
    * @param Carbon dateFilter
    * @return Carbon
    */
    public function getStartPayOutRange($dateFilter = "")
    {
        $dateFilter = ($dateFilter !== "")?$dateFilter:Carbon::now();
        $dayFilter = intval($dateFilter->format('d'));
        $monthFilter = intval($dateFilter->format('m'));
        $yearFilter = intval($dateFilter->format('Y'));
        foreach($this->payOutConfig as $config){
            if($config['day'] === $dayFilter){
                $startDay = $config['rangeStart'];
                break;
            }
        }

        $isPreviousMonth = ($dayFilter < $startDay);
        $month = $monthFilter - ($isPreviousMonth ? 1 : 0);
        $month = ($month <= 0) ? 12 : $month;
        $year = $yearFilter - (($month === 12 && $isPreviousMonth) ? 1 : 0); 

        return Carbon::createFromFormat('Y-m-d', $year.'-'.$month.'-'.$startDay);
    }
    
    
   /**
    * Returns start date of the specified pay-out range
    *
    * @param Carbon dateFilter
    * @return Carbon
    */
    public function getEndPayOutRange($dateFilter = "")
    {
        $dateFilter = ($dateFilter !== "")?$dateFilter:Carbon::now();
        $dayFilter = intval($dateFilter->format('d'));
        $monthFilter = intval($dateFilter->format('m'));
        $yearFilter = intval($dateFilter->format('Y'));
        foreach($this->payOutConfig as $config){
            if($config['day'] === $dayFilter){
                $endDay = $config['rangeEnd'];
                break;
            }
        }
        
        $isEndOfMonth = ($endDay === 'END_OF_MONTH');
        
        $isPreviousMonth = $isEndOfMonth || ($dayFilter < $endDay);
        $month = $monthFilter - ($isPreviousMonth ? 1 : 0);
        $month = ($month <= 0) ? 12 : $month;
        $year = $yearFilter - (($month === 12 && $isPreviousMonth) ? 1 : 0); 

        $endDay = ($isEndOfMonth)?Carbon::createFromFormat('Y-m',$year.'-'.$month)->endOfMonth()->format('d'):$endDay;

        return Carbon::createFromFormat('Y-m-d', $year.'-'.$month.'-'.$endDay);
    }
    
}

