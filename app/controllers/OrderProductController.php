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
     * GET method for displaying list of accounts for refund
     *
     * @return View
     */
    public function getUsersToRefund()
    {   
        $memberRepository = App::make('MemberRepository');

        $dateFrom = !Input::get('dateFrom') ? Carbon::now()->startOfDay() : Carbon::createFromFormat('Y/m/d', Input::get('dateFrom'))->startOfDay();
        $dateTo = !Input::get('dateTo') ? Carbon::now()->endOfDay() : Carbon::createFromFormat('Y/m/d', Input::get('dateTo'))->endOfDay();
        
        return View::make('pages.refundlist')->with('accountsToRefund', $memberRepository->getUserAccountsToRefund( Input::get('username'), $dateFrom, $dateTo))
                                            ->with('input', Input::all());
    }

    
    /**
     *  GET method for displaying specific order products in a payment account to be paid
     *
     *  @return JSON
     */
    public function getOrderProductsToPay()
    {
        $userdata = Input::get();
        
        $dateFrom =  Carbon::createFromFormat('Y/m/d',$userdata['dateFrom'])->startOfDay();
        $dateTo =  Carbon::createFromFormat('Y/m/d',$userdata['dateTo'] )->endOfDay();
        
        $orderProductRepository = App::make('OrderProductRepository');
        $orderProductStatusRepository = App::make('OrderProductStatusRepository');
        
        $orderProducts = $orderProductRepository->getOrderProductsToPay($userdata['username'], $userdata['accountname'],$userdata['accountno'], $userdata['bankname'],$dateFrom, $dateTo);      
        $completedStatus = $orderProductStatusRepository->getSellerPaidStatus();
        
        $html = View::make('partials.orderproductlist')
                    ->with('orderproducts', $orderProducts)
                    ->with('accountname', $userdata['accountname'])
                    ->with('accountno', $userdata['accountno'])
                    ->with('bankname', $userdata['bankname'])
                    ->with('memberTitle', 'Buyer')
                    ->with('completedStatus', $completedStatus)
                    ->render();
        return Response::json(array('html' => $html));
    }
    
    /**
     *  GET method for displaying specific order products to be refunded for each user
     *
     *  @return JSON
     */
    public function getOrderProductsToRefund()
    {
        $userdata = Input::get();
        
        $dateFrom =  Carbon::createFromFormat('Y/m/d',$userdata['dateFrom'])->startOfDay();
        $dateTo =  Carbon::createFromFormat('Y/m/d',$userdata['dateTo'])->endOfDay();
        
        $orderProductRepository = App::make('OrderProductRepository');
        $orderProductStatusRepository = App::make('OrderProductStatusRepository');
 
        $orderProducts = $orderProductRepository->getOrderProductsToRefund($userdata['username'], $dateFrom, $dateTo);      
        $completedStatus = $orderProductStatusRepository->getBuyerPaidStatus();

        $html = View::make('partials.orderproductlist')
                    ->with('orderproducts', $orderProducts)
                    ->with('memberTitle', 'Seller')
                    ->with('completedStatus', $completedStatus)
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
     *  GET method for displaying payment details for an order product to be paid
     *
     *  @return JSON
     */
    public function getOrderProductPaymentDetailToPay()
    {
        $userdata = Input::get();
        $orderProductRepository = App::make('OrderProductRepository');
        $billingInfoRepository = App::make('BillingInfoRepository');
        $bankInfoRepository = App::make('BankInfoRepository');
        
        $orderProduct = $orderProductRepository->getOrderProductById($userdata['order_product_ids'][0]);
        $paymentAccounts = $billingInfoRepository->getBillingAccountsByMemberId($orderProduct->seller_id);
        $bankList = $bankInfoRepository->getAllBanks();

        $html = View::make('partials.orderproductbilling')
                    ->with('accounts', $paymentAccounts)
                    ->with('defaultAccount', $orderProduct->sellerBillingInfo)
                    ->with('seller_id', $orderProduct->seller_id)
                    ->with('order_product_ids', json_encode($userdata['order_product_ids']))
                    ->with('bankList', $bankList)
                    ->with('action', 'pay')
                    ->render();
        return Response::json(array('html' => $html));
    }

    
    /**
     *  GET method for displaying payment details for an order product to be refunded
     *
     *  @return JSON
     */
    public function getOrderProductPaymentDetailToRefund()
    {
        $userdata = Input::get();
        $orderProductRepository = App::make('OrderProductRepository');
        $billingInfoRepository = App::make('BillingInfoRepository');
        $bankInfoRepository = App::make('BankInfoRepository');
        
        $orderProduct = $orderProductRepository->getOrderProductById($userdata['order_product_ids'][0]);
        
        $buyerId = $orderProduct->order->buyer_id;
        
        $paymentAccounts = $billingInfoRepository->getBillingAccountsByMemberId($buyerId);
        $bankList = $bankInfoRepository->getAllBanks();

        $html = View::make('partials.orderproductbilling')
                    ->with('accounts', $paymentAccounts)
                    ->with('buyer_id', $buyerId)
                    ->with('order_product_ids', json_encode($userdata['order_product_ids']))
                    ->with('bankList', $bankList)
                    ->with('action', 'refund')
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
        $memberRepository = App::make('MemberRepository');
        $orderProductRepository = App::make('OrderProductRepository');
        $orderProductStatusRepository = App::make('OrderProductStatusRepository');
        $orderProductHistoryRepository = App::make('OrderProductHistoryRepository');
        $orderBillingInfoRepository = App::make('OrderBillingInfoRepository');
                
        $isPay = $action === 'pay';
        $isValidAction = $isPay ? true : ($action == 'refund');

        if($isValidAction){
            
            $orderProductIds = json_decode(Input::get('order_product_ids'));
            $accountName = Input::get('account_name');
            $accountNumber = Input::get('account_number');
            $bankName = Input::get('bank_name');
            $userId = Input::get('member_id');
            
            $dateFrom = Carbon::createFromFormat('Y/m/d',  Input::get('dateFrom'));
            $dateTo = Carbon::createFromFormat('Y/m/d',  Input::get('dateTo'));

            $member = $memberRepository->getMemberById($userId);
            $orderProducts = $orderProductRepository->getManyOrderProductById($orderProductIds);
            foreach($orderProducts as $orderProduct){ 
                $orderProductId = $orderProduct->id_order_product;

                if($isPay){
                    $status = $orderProductStatusRepository->getSellerPaidStatus();
                    $orderBillingInfoId = $orderProduct->sellerBillingInfo->id_order_billing_info;
                    $orderBillingInfoRepository->updateOrderBillingInfo($orderBillingInfoId, $accountName, $accountNumber, $bankName);
                }else{
                    $status = $orderProductStatusRepository->getBuyerPaidStatus();
                    $orderBillingInfoRepository->createOrderBillingInfo($accountName, $accountNumber, $bankName);
                    $orderBillingInfoId = $orderBillingInfoRepository->currentId;
                    $orderProductRepository->updateOrderProductBuyerBillingId($orderProductId, $orderBillingInfoId);
                }
                
                $orderProductRepository->updateOrderProductStatus($orderProductId, $status);
                $orderProductHistoryRepository->createOrderProductHistory($orderProductId, $status);
              
            }

            $this->emailService->sendPaymentNotice($member, $orderProducts, $accountName, $accountNumber, $bankName, $dateFrom, $dateTo, $action);

            return Response::json(true);
        }
        
        return Response::json(false);
    }
    

    
    
}
