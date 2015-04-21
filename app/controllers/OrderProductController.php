<?php

use Easyshop\Services\EmailService;
use Easyshop\Services\TransactionService;
use Easyshop\Services\CustomPaginator;
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
        } 
        else{
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
        $orderProductIds = explode(',' , Input::get('order_product_ids'));

        $orderProductRepository = App::make('OrderProductRepository');
        $orderProductStatusRepository = App::make('OrderProductStatusRepository');
        
        $completedStatus = $orderProductStatusRepository->getSellerPaidStatus();
        $orderProducts = $orderProductRepository->getOrderProductsToPay($orderProductIds);                                        
        $firstOrderProduct = $orderProducts[0];
                     
        $html = View::make('partials.orderproductlist')
                    ->with('orderproducts', $orderProducts)
                    ->with('accountname', $firstOrderProduct->account_name)
                    ->with('accountno',  $firstOrderProduct->account_number)
                    ->with('bankname', $firstOrderProduct->bank_name)
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
        $orderProductIds = explode(',' , Input::get('order_product_ids'));

        $orderProductRepository = App::make('OrderProductRepository');
        $orderProductStatusRepository = App::make('OrderProductStatusRepository');
 
        $orderProducts = $orderProductRepository->getOrderProductsToRefund($orderProductIds);      
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
        $orderProductPointData = $orderProductRepository->getOrderProductPoint($orderProduct->id_order_product);
        $html = View::make('partials.orderproducthistorylist')
                    ->with('orderproduct', $orderProduct)
                    ->with('easypoints', $orderProductPointData['point'])
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
        $transactionService = App::make('TransactionService');
        
        $orderProduct = $orderProductRepository->getOrderProductById($userdata['order_product_ids'][0]);
        $paymentAccounts = $billingInfoRepository->getBillingAccountsByMemberId($orderProduct->seller_id);
        $bankList = $bankInfoRepository->getAllBanks();

        $html = View::make('partials.orderproductbilling')
                    ->with('accounts', $paymentAccounts)
                    ->with('defaultAccount', $transactionService->getSellerBillingInfo($orderProduct))
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
        
        $member = $memberRepository->getById($userId);
        $orderProducts = $orderProductRepository->getManyOrderProductById($orderProductIds);

        $errors = $transactionService->updateOrderProductsAsPaid($orderProducts, $accountName, $accountNumber, $bankName);
        $emailService->sendPaymentNotice($member, $orderProducts, $accountName, $accountNumber, $bankName);

        return  Response::json([
            'success' => count($errors) > 0,
            'errors' => $errors,
        ]);
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
        foreach($orderProducts as $orderProduct){
            $transactionService->revertOrderPoints($orderProduct);
        }
        
        $emailService->sendPaymentNotice($member, $orderProducts, $accountName, $accountNumber, $bankName, true);

        return  Response::json([
            'success' => count($errors) > 0,
            'errors' => $errors,
        ]);
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
        $orderProductRepository = App::make('OrderProductRepository');
        $tagRepository = App::make('TagTypeRepository');

        $userData = [
            'fullname' => trim(Input::get('fullname')),
            'store_name' => trim(Input::get('store_name')),
            'contactno' => trim(Input::get('number')),
            'email' => trim(Input::get('email')),
            'transactionid' => trim(Input::get('transactionid')),
            'invoiceno' => trim(Input::get('invoiceno')),
            'tag' => trim(Input::get('tag')),
        ];

        $transactionRecord = $orderProductRepository->getAllSellersTransaction(100,true,$userData);
        $pagination = $transactionRecord->appends(Input::except(['page','_token']))->links();

        $constantArray['confirmed'] = $tagRepository->getConfirmed();
        $constantArray['refund'] = $tagRepository->getRefund();
        $constantArray['contacted'] = $tagRepository->getContacted(); 

        $defaultStatus = $tagRepository->getSellerTags();
        $nonDefaultStatus = $tagRepository->getSellerTags(true);

        return View::make('pages.payoutsellerlist')
                    ->with('transactionRecord', $transactionRecord)
                    ->with('constantValues', $constantArray)
                    ->with('defaultStatus', $defaultStatus)
                    ->with('nonDefaultStatus', $nonDefaultStatus)
                    ->with('tagType', Input::get('tag'))
                    ->with('pagination', $pagination);
    }

    /**
     * Get all sellers with existing transactions
     * @return view
     */
    public function getOrderProductsContactBuyer()
    {
        $orderProductRepository = App::make('OrderProductRepository');
        $tagRepository = App::make('TagTypeRepository');

        $userData = [
            'fullname' => Input::get('fullname'),
            'store_name' => Input::get('store_name'),
            'contactno' => Input::get('number'),
            'email' => Input::get('email'),
            'tag' => Input::get('tag'),
        ];

        $transactionRecord = $orderProductRepository->getAllSellersTransaction(100,true,$userData, true);
        $pagination = $transactionRecord->appends(Input::except(['page','_token']))->links();

        $constantArray['payout'] = $tagRepository->getPayOut();
        $constantArray['contacted'] = $tagRepository->getContacted(); 

        $defaultStatus = $tagRepository->getBuyerTags();
        $nonDefaultStatus = $tagRepository->getBuyerTags(true);

        return View::make('pages.payoutsbuyers')
                    ->with('transactionRecord', $transactionRecord)
                    ->with('constantValues', $constantArray)
                    ->with('defaultStatus', $defaultStatus)
                    ->with('nonDefaultStatus', $nonDefaultStatus)
                    ->with('tagType', Input::get('tag'))
                    ->with('pagination', $pagination);
    }    

    /**
     * Get all existing transaction details of the specific seller by order id
     * @return JSON
     */
    public function getSellerTransactionDetailsByOrderId()
    { 
        $orderId = Input::get('order_id'); 
        $memberId = Input::get('member_id');
        $currentTag = Input::get('current_tag');
        $forBuyer = (bool) Input::get('forBuyer');

        $orderProductRepository = App::make('OrderProductRepository'); 
        $tagRepository = App::make('TagTypeRepository');
        $payoutService = App::make('PayoutService');
        $transactionDetails = $orderProductRepository->getOrderProductBySellerOngoing($orderId, $memberId, $currentTag, $forBuyer);

        $payoutService->applyStatusOrderProductValidate($transactionDetails,$forBuyer);

        $html = View::make('partials.payoutsellertransactiondetails')
                        ->with('transactionDetails', $transactionDetails)
                        ->with('isFilter', $currentTag)
                        ->with('contactedTag', $tagRepository->getContacted())
                        ->render();

        return Response::json(['html' => $html]); 
    } 


    /**
     * Get all existing transaction details of the specific seller by order id
     * @return JSON
     */
    public function getBuyerTransactionDetailsByOrderId($suggestForRefund = false)
    { 

        $orderId = Input::get('order_id'); 
        $sellerId = Input::get('seller_id');  

        // prepare repository needed
        $orderProductRepository = App::make('OrderProductRepository');

        // Query the transactions 
        $transactionDetails = $orderProductRepository->getOrderProductByOrderId($orderId, $sellerId);

        $payoutService = App::make('PayoutService');

        $checkOrder = $payoutService->checkOrderProductTagStatus($orderId,$sellerId, FALSE);
        $availableTags = $checkOrder['tags'];
        $currentStatus = $checkOrder['current_status'];
        $requestForPayout = $checkOrder['request_payout'];

        $html = View::make('partials.payoutbuyertransactiondetails')
            ->with('orderId', $orderId) 
            ->with('transactionDetails', $transactionDetails) 
            ->with('suggestForPayOut', $requestForPayout) 
            ->with('sellerId', $sellerId) 
            ->with('tags', $availableTags) 
            ->render();

        return Response::json(array('html' => $html)); 
    }     

    /**
     * Update or Insert to order product tag
     * @return JSON
     */
    public function updateOrderProductTagStatus()
    {
 
        $orderId = Input::get('order_id'); 
        $memberId = Input::get('member_id');
        $tagType = Input::get('tag_type');
        $orderProductIds = Input::get('order_product_ids');
        $adminMemberId = Auth::id();
        $isBuyer = Input::get("forBuyer");

        $payoutService = App::make('PayoutService');
        $orderTagStatus = $payoutService->updateOrderProductTagStatus($orderId
                                                                    ,$memberId
                                                                    ,$tagType
                                                                    ,$adminMemberId
                                                                    ,$orderProductIds
                                                                    ,$isBuyer);

        return Response::json($orderTagStatus);
    }

    /**
     * Retrieves shipping details of a posted order_product_id
     * @return JSON En
     */
    public function getOrderProductShippingDetails()
    {
        // get input data
        $orderProductId = Input::get('order_product_id');

        // prepare repositories
        $shippingRepo = App::make('ProductShippingCommentRepository');

        // get shipping details
        $shippingInfo = $shippingRepo->getShippingCommentByOrderProductId($orderProductId);

        $hasShippingInformation = FALSE;
        if($shippingInfo->count() > 0){
            $hasShippingInformation = TRUE;
        }

        // prepare view
        $html = View::make('partials.shippingcommentdetails')
                        ->with('shippingInfo', $shippingInfo)
                        ->with('hasShippingInformation',$hasShippingInformation)
                        ->render();

        return Response::json(array('html' => $html));
    }

    /**
     * Request add shippiing voew
     * @return JSON
     */
    public function getAddShippingDetailsView()
    {
        // get input data
        $orderProductId = Input::get('order_product_id'); 

        // prepare view
        $html = View::make('partials.addshippingdetails')
                        ->with('orderProductId', $orderProductId)
                        ->render();


        return Response::json(array('html' => $html)); 
    }

    public function addShippingDetails()
    {
        $inputData = Input::get();

        $payoutService = App::make('PayoutService'); 
 
        $response = $payoutService->addShippingComment($inputData);

        return Response::json($response);
    }

}
