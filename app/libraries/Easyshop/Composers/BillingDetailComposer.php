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
        $defaultAccount = isset($viewData['defaultAccount']) ? $viewData['defaultAccount'] : null;
        $bankList = $viewData['bankList'];
        $formattedAccounts = array();

        $isAccountExist = false;
        
        foreach($viewData['accounts'] as $idx=>$account){
            $stdAccount = new \stdClass();
            $stdAccount->account_name = $account->bank_account_name;
            $stdAccount->account_number = $account->bank_account_number;
            $stdAccount->bank_name = $account->bankInfo->bank_name;
            $stdAccount->bank_id = $account->bank_id;
            $stdAccount->billing_id = $account->id_billing_info;
            $stdAccount->order_billing_id = null;
        
            if( $defaultAccount &&
                $account->bank_account_name === $defaultAccount->account_name &&
                $account->bank_account_number === $defaultAccount->account_number &&
                $account->bankInfo->bank_name === $defaultAccount->bank_name)
            {

                $swap_temp = $stdAccount;
                if(isset($formattedAccounts[0])){
                    $swap_temp = $formattedAccounts[0];
                    $formattedAccounts[0] = $stdAccount;
                    $formattedAccounts[$idx] = $swap_temp;
                }
                $formattedAccounts[$idx] =  $swap_temp;
                $isAccountExist = true;;
            }else{
                $formattedAccounts[$idx] = $stdAccount;
            }
            
        }
            
        if(!$isAccountExist && $defaultAccount){
            
                $defaultBank = $bankList->filter(function($bank) use ($defaultAccount)
                {
                    if (strtolower($bank->bank_name) == strtolower($defaultAccount->bank_name)) {
                        return true;
                    }
                });
                
                $newStdAccount = new \stdClass();
                $newStdAccount->account_name = $defaultAccount->account_name;
                $newStdAccount->account_number = $defaultAccount->account_number;
                $newStdAccount->bank_name = $defaultAccount->bank_name;
                $newStdAccount->bank_id = $defaultBank->first()->id_bank; 
                $newStdAccount->billing_id = null;
                $newStdAccount->order_billing_id = $defaultAccount->id_order_billing_info;       
                array_unshift($formattedAccounts, $newStdAccount);
        }

 
        $view->with('accounts',  $formattedAccounts);

   
    }
    
    
}
 
