<?php namespace Easyshop\Composers;

use Carbon\Carbon;

class TransactionComposer 
{
    /**
     *    Inject parameters in $view everytime the view is loaded
     *
     *    @param View $view
     */
    public function compose($view)
    {
        $viewData = $view->getData();

        if(isset($viewData['input']['dateFrom'])){
            $dateFrom =  $viewData['input']['dateFrom'];
        }
        else{
            $dateFrom = Carbon::now()->startOfMonth()->startOfDay()->format('Y/m/d');
        }
        
        if(isset($viewData['input']['dateTo'])){
            $dateTo =  $viewData['input']['dateTo'];
        }
        else{
            $dateTo =  Carbon::now()->endOfDay()->format('Y/m/d');
        }
 
        if(isset($viewData['input']['stringFilter'])){
            $string = $viewData['input']['stringFilter'];
        }else{
            $string = '';
        }
        
        $view->with('dateFrom',  $dateFrom)
             ->with('dateTo', $dateTo)
             ->with('string', $string);
    }
}