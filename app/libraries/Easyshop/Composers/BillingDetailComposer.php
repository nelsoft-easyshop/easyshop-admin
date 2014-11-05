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
        
            if( $defaultAccount !== null &&
                $account->bank_account_name === $defaultAccount->account_name &&
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
            }
            else{
                $formattedAccounts[$idx] = $stdAccount;
            }
            
        }
            
        if(!$isAccountExist && $defaultAccount !== null){
                $newStdAccount = new \stdClass();
                $newStdAccount->account_name = $defaultAccount->account_name;
                $newStdAccount->account_number = $defaultAccount->account_number;
                $newStdAccount->bank_name = $defaultAccount->bank_name;
                $newStdAccount->bank_id = $defaultAccount->bank_id; 
                if($defaultAccount->isOrderBillingInfo){
                    $newStdAccount->billing_id = null;
                    $newStdAccount->order_billing_id = $defaultAccount->id;   
                }
                else{
                    $newStdAccount->billing_id = $defaultAccount->id;   
                    $newStdAccount->order_billing_id = null; 
                }
                array_unshift($formattedAccounts, $newStdAccount);
        }

        $view->with('accounts',  $formattedAccounts);

   
    }
    
    
}
 
