<?PHP


class BillingInfoController extends BaseController 
{
        
   /**
    * PUT method for updating payment account
    *
    * @return JSON
    */
    public function updateOrderProductPaymentAccount(){

        $billingInfoRepository = App::make('BillingInfoRepository');
        $errors = $billingInfoRepository->updateBillingAccount(Input::get('billing_info_id'), Input::get('account_name'), Input::get('account_number'), Input::get('bank_id'));

        return Response::json(array('errors' => $errors));
    }

}