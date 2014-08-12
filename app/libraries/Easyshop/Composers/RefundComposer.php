<?php namespace Easyshop\Composers;

use Carbon\Carbon;

class RefundComposer 
{
   /**
    *    Inject parameters in $view everytime the view is loaded
    *
    *    @param View $view
    */
    public function compose($view)
    {
        $viewData = $view->getData();

        $dateFrom = !isset($viewData['input']['dateFrom']) ? Carbon::now()->startOfDay()->format('Y/m/d') : $viewData['input']['dateFrom'];
        $dateTo = !isset($viewData['input']['dateTo']) ? Carbon::now()->endOfDay()->format('Y/m/d') : $viewData['input']['dateTo'];
        $username =   isset($viewData['input']['username']) ? $viewData['input']['username'] : '';
        
        $view->with('dateFrom',  $dateFrom)
             ->with('dateTo', $dateTo)
             ->with('username', $username);
    }
}