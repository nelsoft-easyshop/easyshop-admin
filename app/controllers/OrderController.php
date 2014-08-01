<?PHP


class OrderController extends BaseController 
{

    /**
     *  GET method for displaying list of account to pay
     *
     *  @return View
     */
    public function getUsersToPay()
    {
        $memberRepository = App::make('MemberRepository');
        return View::make('pages.paymentlist')->with('accountsToPay', $memberRepository->getUserAccountsToPay(Input::get('username'), Input::get('year'), Input::get('month'), Input::get('day') ))
                    ->with('input', Input::all());
    }

    
   /**
    *  GET method for displaying specific order products in a payment account
    *
    *  @return JSON
    */
    public function getOrderProducts()
    {
        $userdata = Input::get();
        $orderProductRepository = App::make('OrderProductRepository');
        $orderProducts = $orderProductRepository->getOrderProductByPaymentAccount($userdata['username'], $userdata['accountname'],$userdata['accountno']);      
        $html = View::make('partials.orderproductlist')
                    ->with('orderproducts', $orderProducts)
                    ->render();
        return Response::json(array('html' => $html));
    }

   /**
    *  GET method for displaying order product history
    *
    *  @return JSON
    */
    public function getOrderProductDetail()
    {
        $userdata = Input::get();
        $orderProductRepository = App::make('OrderProductRepository');
        $orderProduct = $orderProductRepository->getOrderProductById($userdata['order_product_id']);
      
        $html = View::make('partials.orderproducthistorylist')
                    ->with('orderproduct', $orderProduct)
                    ->render();
        return Response::json(array('html' => $html));
    }
   
   /**
    *  GET method for displaying payment details for an order product
    *
    *  @return JSON
    */
    public function getOrderProductPaymentDetail(){
        $userdata = Input::get();
        $orderProductRepository = App::make('OrderProductRepository');
        $billingInfoRepository = App::make('BillingInfoRepository');
        $bankInfoRepository = App::make('BankInfoRepository');
        
        $orderProduct = $orderProductRepository->getOrderProductById($userdata['order_product_id']);
        $paymentAccounts = $billingInfoRepository->getBillingAccountsByMemberId($orderProduct->seller_id);
        $bankList = $bankInfoRepository->getAllBanks();

        $html = View::make('partials.orderproductbilling')
                    ->with('accounts', $paymentAccounts)
                    ->with('defaultAccount', $orderProduct->billingInfo)
                    ->with('bankList', $bankList)
                    ->render();
        return Response::json(array('html' => $html));
    }
    
   /**
    * PUT method for updating payment account
    *
    * @return JSON
    */
    public function updateOrderProductPaymentAccount(){
        $rules = array(
            'billing_info_id' => 'required|numeric',
            'account_name' => 'required',
            'account_no' => 'required',
            'bank_id' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            $isSuccessful = false;
            $message = $validator->messages();
        }else{
            $userdata = Input::get();
            $billingInfoRepository = App::make('BillingInfoRepository');
            $billingInfoRepository->saveBillingAccount($userdata['billing_info_id'], $userdata['account_name'], $userdata['account_number'], $userdata['bank_id']);
        }
        
    }
    
    
}
