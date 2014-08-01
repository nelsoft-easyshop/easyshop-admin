<?php namespace Easyshop\Composers;

use Easyshop\Services\TransactionService as TransactionService;
use Carbon\Carbon;
use Config;

class PaymentComposer 
{
 
    //Year for start of year selection data
    private $yearStart;
    private $transactionService;
    
    public function __construct(TransactionService $transactionService)
    {
        $this->yearStart = Config::get('transaction.startOfOperation')->format('Y');
        $this->transactionService = $transactionService; 
    }
    
    /**
    *    Inject parameters in $view everytime the view is loaded
    *
    *    @param View $view
    */
    public function compose($view)
    {        
        $viewData = $view->getData();

        if(isset($viewData['input']['month']) && isset($viewData['input']['year']) && isset($viewData['input']['day'])){
            $nextPayOutDate = Carbon::createFromFormat('Y-m-d', $viewData['input']['year'].'-'.$viewData['input']['month'].'-'.$viewData['input']['day']);
        }else{
            $nextPayOutDate = $this->transactionService->getNextPayoutDate();
        }
        $yeardiff = date('Y') - $this->yearStart;
        $yearSelection = array();
        do{
            $year = $this->yearStart + $yeardiff;
            array_push($yearSelection, ['year' => $year, 
                                        'selected' =>  (intval($year) === intval($nextPayOutDate->format('Y')))]);
            $yeardiff--;
        }while($yeardiff >= 0);
        
        $payOutDays = $this->transactionService->getPayOutDays();
        $daySelection = array();
        foreach($payOutDays as $day){
            array_push($daySelection, ['day' => $day, 
                                    'selected' => (intval($day) === intval($nextPayOutDate->format('d')))]);                                      
        }

        $view->with('yearSelection',  $yearSelection)
             ->with('dateSelection', $daySelection) 
             ->with('defaultMonth', $nextPayOutDate->format('m'))
             ->with('username', isset($viewData['input']['username'])?$viewData['input']['username']:'');

    }

}