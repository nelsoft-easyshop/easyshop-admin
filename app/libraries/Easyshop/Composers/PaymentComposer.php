<?php namespace Easyshop\Composers;

use Easyshop\Services\TransactionService as TransactionService;

class PaymentComposer 
{
 
    //Year for start of year selection data
    private $yearStart;
    private $transactionService;
    
    public function __construct(TransactionService $transactionService){
        $this->yearStart = '2013';
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
             $nextPayOutDate = strtotime($viewData['input']['year'].'-'.$viewData['input']['month'].'-'.$viewData['input']['day']) ;
        }else{
            $this->transactionService->getLastPayoutDate();
            $nextPayOutDate = strtotime($this->transactionService->getNextPayoutDate());
        }
        
        $yeardiff = date('Y') - $this->yearStart;
        $yearSelection = array();
        do{
            $year = $this->yearStart + $yeardiff;
            array_push($yearSelection, ['year' => $year, 
                                        'selected' =>  (intval($year) === intval(date('Y',$nextPayOutDate)))]);
            $yeardiff--;
        }while($yeardiff >= 0);
        
        $payOutDays = $this->transactionService->getPayOutDays();
        $daySelection = array();
        foreach($payOutDays as $day){
            array_push($daySelection, ['day' => $day, 
                                    'selected' => (intval($day) === intval(date('d',$nextPayOutDate)))]);                                      
        }

        $view->with('yearSelection',  $yearSelection)
             ->with('dateSelection', $daySelection) 
             ->with('defaultMonth', date('m', $nextPayOutDate))
             ->with('username', isset($viewData['input']['username'])?$viewData['input']['username']:'');

    }

}