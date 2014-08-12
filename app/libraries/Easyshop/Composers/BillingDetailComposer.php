<?php namespace Easyshop\Composers;

class BillingDetailComposer
{
   /**
    *    Inject parameters in $view everytime the view is loaded
    *
    *    @param View $view
    */
    public function compose($view)
    {
        $viewData = $view->getData();
        $defaultAccount = $viewData['defaultAccount'];

        if($defaultAccount){
            foreach($viewData['accounts'] as $idx=>$account){
                if($account->bank_account_name === $defaultAccount->account_name &&
                   $account->bank_account_number === $defaultAccount->account_number &&
                   $account->bankInfo->bank_name === $defaultAccount->bank_name)
                {
                   $swap_temp = $viewData['accounts'][0];
                   $viewData['accounts'][0] = $viewData['accounts'][$idx];
                   $viewData['accounts'][$idx] = $swap_temp;
                }
                   
            }
        }

        $view->with('accounts',  $viewData['accounts']);
   
    }
    
    
}
 
