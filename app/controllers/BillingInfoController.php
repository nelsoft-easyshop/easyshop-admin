<?PHP

use Easyshop\Services\Validation\Laravel\BillingInfoUpdateValidator;
use Easyshop\Services\Validation\Laravel\BillingInfoCreateValidator;

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
        $validator = new BillingInfoUpdateValidator( App::make('validator') );

        if($validator->with(Input::get())->passes()){
            $billingInfoRepository->updateBillingAccount(Input::get('billing_info_id'),
                                                        Input::get('account_name'), 
                                                        Input::get('account_number'),
                                                        Input::get('bank_id'),  
                                                        Input::get('member_id') );
        }
        
        return Response::json(array('errors' => $validator->errors()));
    }
    
             
    /**
     * POST method for creating new payment account
     *
     * @return JSON
     */
    public function createOrderProductPaymentAccount()
    {
        $billingInfoRepository = App::make('BillingInfoRepository');
        $validator = new BillingInfoCreateValidator( App::make('validator') );
        
        if($validator->with(Input::get())->passes()){
            $billingInfoRepository->createBillingAccount(Input::get('account_name'),
                                                Input::get('account_number'),
                                                Input::get('bank_id'), 
                                                Input::get('member_id'));
        }
        
        return Response::json(
            array('errors' =>  $validator->errors(), 
                  'newBillingInfoId' => $billingInfoRepository->getLastId()
            )
        );
    }

}