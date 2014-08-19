<?php

use Easyshop\Services\EmailService;
use Easyshop\Services\TransactionService;
use Easyshop\Services\Validation\Laravel\OrderBillingInfoUpdateValidator;
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
        
        $orderProducts = $orderProductRepository->getOrderProductByPaymentAccount($userdata['username'], 
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
        
        $orderProduct = $orderProductRepository->getOrderProductById($userdata['order_product_ids'][0]);
        $paymentAccounts = $billingInfoRepository->getBillingAccountsByMemberId($orderProduct->seller_id);
        $bankList = $bankInfoRepository->getAllBanks();

        $html = View::make('partials.orderproductbilling')
                    ->with('accounts', $paymentAccounts)
                    ->with('defaultAccount', $orderProduct->sellerBillingInfo)
                    ->with('seller_id', $orderProduct->seller_id)
                    ->with('order_product_ids', json_encode($userdata['order_product_ids']))
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
        $memberRepository = App::make('MemberRepository');
        $orderProductRepository = App::make('OrderProductRepository');
        $orderProductStatusRepository = App::make('OrderProductStatusRepository');
        $orderProductHistoryRepository = App::make('OrderProductHistoryRepository');
        $orderProductBillingInfoRepository = App::make('OrderBillingInfoRepository');
        $emailService = App::make('EmailService');
        $orderBillingInfoUpdateValidator = new OrderBillingInfoUpdateValidator( App::make('validator') );
        
        $isValidAction = false;
        if($action === 'forward'){
            $status = $orderProductStatusRepository->getSellerPaidStatus();
            $isValidAction = true;
        }else if($action === 'return'){
            $status = $orderProductStatusRepository->getBuyerPaidStatus();
            $isValidAction = true;
        }
        
        if($isValidAction){
            
            $orderProductIds = json_decode(Input::get('order_product_ids'));
            $accountName = Input::get('account_name');
            $accountNumber = Input::get('account_number');
            $bankName = Input::get('bank_name');
            $userId = Input::get('seller_id');
            
            $dateFrom = Carbon::createFromFormat('m-d-Y',  Input::get('dateFrom'));
            $dateTo = Carbon::createFromFormat('m-d-Y',  Input::get('dateTo'));

            $member = $memberRepository->getMemberById($userId);
            $orderProducts = $orderProductRepository->getManyOrderProductById($orderProductIds);
            foreach($orderProducts as $orderProduct){ 
                $orderProductId = $orderProduct->id_order_product;
                $orderBillingInfoId = $orderProduct->sellerBillingInfo->id_order_billing_info;
                
 
                $orderBillingInfoUpdateValidator->with(
                    array('order_billing_info_id' => $orderBillingInfoId,
                          'account_name' => $accountName,
                          'account_number' => $accountNumber,
                          'bank_name' => $bankName)
                );

                if($orderBillingInfoUpdateValidator->passes()){
                    $orderProductBillingInfoRepository->updateOrderBillingInfo($orderBillingInfoId, $accountName, $accountNumber, $bankName);
                }

                $orderProductRepository->updateOrderProductStatus($orderProductId, $status);
                $orderProductHistoryRepository->createOrderProductHistory($orderProductId, $status);
            }

            $emailService->sendPaymentNotice($member, $orderProducts, $accountName, $accountNumber, $bankName, $dateFrom, $dateTo);

            return Response::json(true);
        }
        
        return Response::json(false);
    }
    
    
    public function getAllValidTransactions()
    {
        return View::make('pages.transactionlist');
    }
    
    
}
