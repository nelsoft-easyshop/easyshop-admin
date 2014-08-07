<?PHP

use Easyshop\Services\EmailService as EmailService;
use Easyshop\Services\TransactionService as TransactionService;
use Carbon\Carbon;

class OrderProductController extends BaseController 
{

    private $emailService;
    private $transactionService;

    public function __construct(EmailService $emailService, TransactionService $transactionService)
    {
        $this->emailService = $emailService;
        $this->transactionService = $transactionService;
    }

    /**
     *  GET method for displaying list of account to pay
     *
     *  @return View
     */
    public function getUsersToPay()
    {        
        $memberRepository = App::make('MemberRepository');
        
        if(!(Input::get('year') && Input::get('month') && Input::get('day'))){
            $dateFilter = $this->transactionService->getNextPayOutDate();
        }else{
            $dateFilter = Carbon::createFromFormat('Y-m-d', Input::get('year').'-'.Input::get('month').'-'.Input::get('day'));
        }
        $dateFrom = $this->transactionService->getStartPayOutRange($dateFilter);
        $dateTo = $this->transactionService->getEndPayOutRange($dateFilter);

        return View::make('pages.paymentlist')->with('accountsToPay', $memberRepository->getUserAccountsToPay(Input::get('username'), $dateFrom, $dateTo ))
                    ->with('dateFrom',$dateFrom)
                    ->with('dateTo', $dateTo)
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
        
        $dateFrom =  Carbon::createFromFormat('m-d-Y',$userdata['dateFrom']);
        $dateTo =  Carbon::createFromFormat('m-d-Y',$userdata['dateTo'] );
        
        $orderProductRepository = App::make('OrderProductRepository');
        $orderProducts = $orderProductRepository->getOrderProductByPaymentAccount($userdata['username'], $userdata['accountname'],$userdata['accountno'], $userdata['bankname'],$dateFrom, $dateTo);      
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
    public function getOrderProductPaymentDetail()
    {
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
                    ->with('seller_id', $orderProduct->seller_id)
                    ->with('order_product_id', $orderProduct->id_order_product)
                    ->with('bankList', $bankList)
                    ->render();
        return Response::json(array('html' => $html));
    }

    
   /**
    * Updates the status of an order product
    *
    * @parameter string $action
    * @return JSON
    */
    public function updateOrderProductStatus($action)
    {
        $orderProductStatusRepository = App::make('OrderProductStatusRepository');
        $memberRepository = App::make('MemberRepository');
        $orderProductRepository = App::make('OrderProductRepository');
        $orderProductHistoryRepository = App::make('OrderProductHistoryRepository');
        
        $isValidAction = false;
        if($action === 'forward'){
            $status = $orderProductStatusRepository->getSellerPaidStatus();
            $isValidAction = true;
        }else if($action === 'return'){
            $status = $orderProductStatusRepository->getBuyerPaidStatus();
            $isValidAction = true;
        }
        
        if($isValidAction){
            $orderProductId = Input::get('order_product_id');
            $accountName = Input::get('account_name');
            $accountNumber = Input::get('account_number');
            $bankName = Input::get('bank_name');
            $userId = Input::get('seller_id');
            $dateFrom = Carbon::createFromFormat('m-d-Y',  Input::get('dateFrom'));
            $dateTo = Carbon::createFromFormat('m-d-Y',  Input::get('dateTo'));
            
            
            $member = $memberRepository->getMemberById($userId);
            $orderProducts = $orderProductRepository->getOrderProductByPaymentAccount($member->username, $accountName, $accountNumber, $bankName);      
            $billingAccount = $orderProducts->first()->billingInfo;
            
            #$orderProductRepository->updateOrderProductStatus($orderProductId, $billingAccount->id_order_billing_info, $status);
            #$orderProductHistoryRepository->createOrderProductHistory($orderProductId, $status);
        
            $this->emailService->sendPaymentNotice($member, $orderProducts, $billingAccount, $dateFrom, $dateTo);
 
            return Response::json(true);
        }
        
        return Response::json(false);
    }
    
    
}
