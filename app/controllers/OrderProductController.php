<?php

use Easyshop\Services\EmailService;
use Easyshop\Services\TransactionService;
use Carbon\Carbon;

class OrderProductController extends BaseController 
{

    /**
     *  GET method for displaying list of account to pay
     *
     *  @return View
     */
    public function getUsersToPay()
    {        
        $memberRepository = App::make('MemberRepository');
        $transactionService = App::make('TransactionService');
        
        if(Input::has('year') && Input::has('month') && Input::has('day')) {
            $dateFilter = Carbon::createFromFormat('Y-m-d', Input::get('year').'-'.Input::get('month').'-'.Input::get('day'));
        } else {
            $dateFilter = $transactionService->getNextPayOutDate();
        }
            
        $dateFrom = $transactionService->getStartPayOutRange($dateFilter);
        $dateTo = $transactionService->getEndPayOutRange($dateFilter);

        if(Input::has('username')){
            $accounts = $memberRepository->getUserAccountsToPay($dateFrom, $dateTo, Input::get('username'));
        }
        else{
            $accounts = $memberRepository->getUserAccountsToPay($dateFrom, $dateTo);
        }

        return View::make('pages.paymentlist')
                    ->with('accountsToPay', $accounts)
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

        if(Input::has('dateFrom')){
            $dateFrom = Carbon::createFromFormat('Y/m/d', Input::get('dateFrom'))->startOfDay();
        }   
        else{
            $dateFrom = Carbon::now()->startOfDay();
        }

        if(Input::has('dateTo')){
            $dateTo = Carbon::createFromFormat('Y/m/d', Input::get('dateTo'))->endOfDay();
        }   
        else{
           $dateTo = Carbon::now()->endOfDay();
        }

        if(Input::has('username')){
            $accounts = $memberRepository->getUserAccountsToRefund($dateFrom, $dateTo, Input::get('username'));
        }
        else{
            $accounts = $memberRepository->getUserAccountsToRefund($dateFrom, $dateTo);
        }
        
        return View::make('pages.refundlist')
                    ->with('accountsToRefund', $accounts)
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
        
        $completedStatus = $orderProductStatusRepository->getSellerPaidStatus();
        $orderProducts = $orderProductRepository->getOrderProductsToPay($userdata['username'], 
                                                                        $userdata['accountname'],
                                                                        $userdata['accountno'], 
                                                                        $userdata['bankname'],
                                                                        $dateFrom, 
                                                                        $dateTo);      
        $orderProducts = $orderProductRepository->getOrderProductsToPay($userdata['username'], 
                                                                        $userdata['accountname'],
                                                                        $userdata['accountno'], 
                                                                        $userdata['bankname'],
                                                                        $dateFrom, 
                                                                        $dateTo);  
                                                                        
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
     * Updates the status of multiple order products as paid
     *
     * @return JSON
     */
    public function payOrderProducts()
    {        
        $memberRepository = App::make('MemberRepository');
        $orderProductRepository = App::make('OrderProductRepository');
        $transactionService = App::make('TransactionService');
        $emailService = App::make('EmailService');

        $orderProductIds = json_decode(Input::get('order_product_ids'));
        $accountName = Input::get('account_name');
        $accountNumber = Input::get('account_number');
        $bankName = Input::get('bank_name');
        $userId = Input::get('member_id');

        $dateFrom = Carbon::createFromFormat('Y/m/d',  Input::get('dateFrom'));
        $dateTo = Carbon::createFromFormat('Y/m/d',  Input::get('dateTo'));

        $member = $memberRepository->getById($userId);
        $orderProducts = $orderProductRepository->getManyOrderProductById($orderProductIds);

        $errors = $transactionService->updateOrderProductsAsPaid($orderProducts, $accountName, $accountNumber, $bankName);
        $emailService->sendPaymentNotice($member, $orderProducts, $accountName, $accountNumber, $bankName, $dateFrom, $dateTo);

        return  Response::json(
            array('success' => count($errors) > 0,
                  'errors' => $errors)
        );
        
    }
    
    /**
     * Updates the status of multiple order products as refunded
     *
     * @return JSON
     */
    public function refundOrderProducts()
    {        
        $memberRepository = App::make('MemberRepository');
        $orderProductRepository = App::make('OrderProductRepository');
        $transactionService = App::make('TransactionService');
        $emailService = App::make('EmailService');
        
        $orderProductIds = json_decode(Input::get('order_product_ids'));
        $accountName = Input::get('account_name');
        $accountNumber = Input::get('account_number');
        $bankName = Input::get('bank_name');
        $userId = Input::get('member_id');

        $dateFrom = Carbon::createFromFormat('Y/m/d',  Input::get('dateFrom'));
        $dateTo = Carbon::createFromFormat('Y/m/d',  Input::get('dateTo'));

        $member = $memberRepository->getById($userId);
        $orderProducts = $orderProductRepository->getManyOrderProductById($orderProductIds);

        $errors = $transactionService->updateOrderProductsAsRefunded($orderProducts, $accountName, $accountNumber, $bankName);
        $emailService->sendPaymentNotice($member, $orderProducts, $accountName, $accountNumber, $bankName, $dateFrom, $dateTo, true);

        return  Response::json(
            array('success' => count($errors) > 0,
                  'errors' => $errors)
        );
    }
        
    /**
     * PUT method for voiding a transaction
     *
     * @return JSON
     */
    public function voidOrderProduct()
    {
        $userdata = Input::get();
        $transactionService = App::make('TransactionService');
        $isSuccess = $transactionService->voidOrderProduct($userdata['order_product_id']);

        return Response::json(array('success' => $isSuccess));
    }
        
    public function downloadTransactionRecord()
    {
        $orderRepository = App::make('OrderRepository');

        $dateFrom = Carbon::createFromFormat('Y/m/d',  Input::get('dateFrom'))->startOfDay();
        $dateTo = Carbon::createFromFormat('Y/m/d',  Input::get('dateTo'))->endOfDay();
        $transactionRecord = $orderRepository->getTransactionRecord(
                                            $dateFrom,
                                            $dateTo, 
                                            Input::get('stringFilter')
                                        );
        $excelService = App::make('Easyshop\Services\ExcelService');
        $excelService->transactionRecord('EasyshopRecord', $transactionRecord);
    }

    /**
     * Get all sellers with existing transactions
     * @return view
     */
    public function getSellersTransactions()
    {
        // prepare repository needed
        $orderRepository = App::make('OrderProductRepository');

        // Query the transactions
        $transactionRecord = $orderRepository->getAllSellersTransaction();

        // Render the view
        return View::make('pages.payoutsellerlist')
                    ->with('transactionRecord', $transactionRecord);
    }

    /**
     * Get all existing transaction details of the specific seller by order id
     * @return JSON
     */
    public function getSellerTransactionDetailsByOrderId()
    { 
        // get input data
        $orderId = Input::get('order_id'); 
        $memberId = Input::get('member_id');

        // prepare repository needed
        $orderRepository = App::make('OrderProductRepository');
        $tagRepository = App::make('TagTypeRepository');

        //prepare service
        $payoutService = App::make('PayoutService');

        // Query the transactions 
        $transactionDetails = $orderRepository->getOrderProductByOrderId($orderId,$memberId);

        // get available tags
        $orderTagStatus = $payoutService->checkOrderProductTagStatus($orderId,$memberId);
        $availableTags = $orderTagStatus['tags'];
        $currentStatus = $orderTagStatus['current_status'];
        $requestForRefund = $orderTagStatus['request_refund'];

        $html = View::make('partials.payoutsellertransactiondetails')
            ->with('transactionDetails', $transactionDetails) 
            ->with('tags', $availableTags)
            ->with('currentStatus', $currentStatus)
            ->with('requestForRefund', $requestForRefund)
            ->render();


        return Response::json(array('html' => $html)); 
    } 

    public function getOrderProductsContactBuyer()
    {
        $taggedStatus = array();
        $orders = array();
        $orderProductRepository = App::make('OrderProductRepository'); 
        $orderProductTagRepositoryRepository = App::make('OrderProductTagRepository'); 

        foreach (array_flatten($orderProductRepository->getBuyersTransactionWithShippingComment()) as $value) {

            $dt = Carbon::create(Carbon::parse($value->expected_date)->year
                                , Carbon::parse($value->expected_date)->month
                                , Carbon::parse($value->expected_date)->day);
            if(Carbon::now() > $dt->addDays(2)) {
                $orders[] = $value;            
                $taggedStatus[] = $orderProductTagRepositoryRepository->getOrdersTagStatus($value->id_order_product);                
            }
            
        }

        return View::make("pages.payoutsbuyer")
                    ->with("status", $taggedStatus)
                    ->with("orders", array_flatten($orders) );
    }

    public function insertContactedBuyer()
    {
        $orderProductTagRepositoryRepository = App::make('OrderProductTagRepository');         
        foreach(array_flatten(Input::all()) as $ids) {
            $orderProductTagRepositoryRepository->insertContactedBuyer($ids);
        }
    }


    /**
     * Get all existing transaction details of the specific seller by order id
     * @return JSON
     */
    public function getBuyerTransactionDetailsByOrderId()
    { 
        $orderId = Input::get('order_id'); 

        // prepare repository needed
        $orderProductRepository = App::make('OrderProductRepository');
        $tagRepository = App::make('TagTypeRepository');

        // Query the transactions 
        $transactionDetails = $orderProductRepository->getOrderProductByOrderId($orderId);

        // get available tags

        if($orderProductRepository->checkOrderIfContact($orderId)) {
            $availableTags = $tagRepository->getBuyerTags(true); 
        }
        else {
            $availableTags = $tagRepository->getBuyerTags();             
        }



        $html = View::make('partials.payoutbuyertransactiondetails')
            ->with('transactionDetails', $transactionDetails) 
            ->with('tags', $availableTags) 
            ->render();

        return Response::json(array('html' => $html)); 
    }     

        return Response::json(array('html' => $html));
    }

    /**
     * Update or Insert to order product tag
     * @return [type] [description]
     */
    public function updateOrderProductStatus()
    {
        // get input data
        $orderId = Input::get('order_id'); 
        $memberId = Input::get('member_id');
        $tagType = Input::get('tag_type');
        $adminMemberId = Auth::id();

        //prepare service
        $payoutService = App::make('PayoutService');

        // Update status
        $orderTagStatus = $payoutService->updateOrderProductTagStatus($orderId
                                                                    ,$memberId
                                                                    ,$tagType
                                                                    ,$adminMemberId);
    }

}
