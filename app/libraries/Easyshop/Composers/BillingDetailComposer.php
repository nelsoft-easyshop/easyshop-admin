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
        $bankList = $viewData['bankList'];
        $formattedAccounts = array();

        if($defaultAccount){
        
            $isAccountExist = false;
            foreach($viewData['accounts'] as $idx=>$account){
            
                $stdAccount = new \stdClass();
                $stdAccount->account_name = $account->bank_account_name;
                $stdAccount->account_number = $account->bank_account_number;
                $stdAccount->bank_name = $account->bankInfo->bank_name;
                $stdAccount->bank_id = $account->bank_id;
                $stdAccount->billing_id = $account->id_billing_info;
                $stdAccount->order_billing_id = null;
            
                if($account->bank_account_name === $defaultAccount->account_name &&
                   $account->bank_account_number === $defaultAccount->account_number &&
                   $account->bankInfo->bank_name === $defaultAccount->bank_name)
                {

                    $swapTemp = $stdAccount;
                    if(isset($formattedAccounts[0])){
                        $swapTemp = $formattedAccounts[0];
                        $formattedAccounts[0] = $stdAccount;
                        $formattedAccounts[$idx] = $swapTemp;
                    }
                    $formattedAccounts[$idx] =  $swapTemp;
                    $isAccountExist = true;
                }else{

                    $formattedAccounts[$idx] = $stdAccount;
                }
            }
            
            if(!$isAccountExist){
            
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
            
            /**
             * TO DO: ADD CODE TO ADD IF NOT FOUND
             *        ADD CODE TO ADD IDENTFIER FOR ORDER_PRODUCT_BILLING_INFO [x]
             *        ORDER_PRODUCT_BILLING_INFO TO ORDER_BILLING_INFO
             */

        }

        $view->with('accounts',  $formattedAccounts);
   
    }
    
    
}
 
