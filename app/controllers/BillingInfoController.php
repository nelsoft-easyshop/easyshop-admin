<?PHP


class BillingInfoController extends BaseController 
{
        
    /**
     * PUT method for updating payment account
     *
     * @return JSON
     */
    public function updateOrderProductPaymentAccount()
    {

        $billingInfoRepository = App::make('BillingInfoRepository');
        $billingInfoRepository->updateBillingAccount(Input::get('billing_info_id'),
                                                        Input::get('account_name'), 
                                                        Input::get('account_number'),
                                                        Input::get('bank_id'),  
                                                        Input::get('seller_id') );
        return Response::json(array('errors' => $billingInfoRepository->getErrors()));
    }
    
             
    /**
     * POST method for creating new payment account
     *
     * @return JSON
     */
    public function createOrderProductPaymentAccount()
    {

        $billingInfoRepository = App::make('BillingInfoRepository');
        $billingInfoRepository->createBillingAccount(Input::get('account_name'),
                                        Input::get('account_number'),
                                        Input::get('bank_id'), 
                                        Input::get('member_id'));
            
        return Response::json(array('errors' => $billingInfoRepository->getErrors(), 'new_billing_info_id' => $billingInfoRepository->getLastId()));
    }

}