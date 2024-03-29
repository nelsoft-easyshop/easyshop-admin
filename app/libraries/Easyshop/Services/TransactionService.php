<?php namespace Easyshop\Services;

use App;
use Config;
use Carbon\Carbon;
use PointType;
use OrderStatus;
use OrderPoint;
use OrderProductStatus;
use Easyshop\Services\Validation\Laravel\OrderBillingInfoUpdateValidator;
use Easyshop\Services\Validation\Laravel\OrderBillingInfoCreateValidator;
use Easyshop\Services\PointTracker;
use EasyShop\Services\EmailService as EmailService;

use Easyshop\ModelRepositories\OrderProductStatusRepository as OrderProductStatusRepository;
use Easyshop\ModelRepositories\OrderBillingInfoRepository as OrderBillingInfoRepository;
use Easyshop\ModelRepositories\OrderProductRepository as OrderProductRepository;
use Easyshop\ModelRepositories\OrderProductHistoryRepository as OrderProductHistoryRepository;
use Easyshop\ModelRepositories\OrderRepository as OrderRepository;
use Easyshop\ModelRepositories\OrderStatusRepository as OrderStatusRepository;
use Easyshop\ModelRepositories\OrderHistoryRepository as OrderHistoryRepository;
use Easyshop\ModelRepositories\PaymentMethodRepository as PaymentMethodRepository;
use Easyshop\ModelRepositories\BankInfoRepository as BankInfoRepository;

/**
 * TransactionService, containing all useful methods for business logic around transactions
 */
class TransactionService
{
    /**
     * Payout configs
     * 
     * @var string[]
     */
    private $payOutConfig;
    
    /**
     * OrderProductStatus Repository
     *
     * @var OrderProductStatusRepository
     */
    private $orderProductStatusRepository;
    
    
    /**
     * OrderBillingInfo Repository
     *
     * @var OrderBillingInfoRepository
     */ 
    private $orderBillingInfoRepository;
    
    /**
     * OrderProduct Repository
     *
     * @var OrderProductRepository
     */ 
    private $orderProductRepository;
    
    /**
     * OrderProductHistory Repository
     *
     * @var OrderProductHistoryRepository
     */ 
    private $orderProductHistoryRepository;
    
    /**
     * Order Repository
     *
     * @var OrderRepository
     */
    private $orderRepository;
    
    /**
     * OrderStatus Repository
     *
     * @var OrderStatusRepository
     */
    private $orderStatusRepository;
    
    /**
     * OrderHistory Repository
     *
     * @var OrderHistoryRepository
     */
    private $orderHistoryRepository;
    
    /**
     * PaymentMethod Repository
     *
     * @var PaymentMethodRepository
     */
    private $paymentMethodRepository;
    
    /**
     * BankInfoRepository
     *
     * @var BankInfoRepository
     */
    private $bankInfoRepository;
    
    /**
     * Point tracker
     *
     * @var EasyShop/Services/PointTracker
     */
    private $pointTracker;


    /**
     * EmailService;
     *
     * @var EasyShop\Services\EmailService
     */
    private $emailService;
    
    /**
     * Inject dependecies
     *
     */
    public function __construct(OrderProductStatusRepository $orderProductStatusRepository,
                                OrderBillingInfoRepository $orderBillingInfoRepository,
                                OrderProductRepository $orderProductRepository,
                                OrderProductHistoryRepository $orderProductHistoryRepository,
                                OrderRepository $orderRepository,
                                OrderStatusRepository $orderStatusRepository,
                                OrderHistoryRepository $orderHistoryRepository,
                                PaymentMethodRepository $paymentMethodRepository,
                                BankInfoRepository $bankInfoRepository,
                                PointTracker $pointTracker,
                                EmailService $emailService)    
    {
        $this->orderProductStatusRepository = $orderProductStatusRepository;
        $this->orderBillingInfoRepository = $orderBillingInfoRepository;
        $this->orderProductRepository = $orderProductRepository;
        $this->orderProductHistoryRepository = $orderProductHistoryRepository; 
        $this->orderRepository = $orderRepository;
        $this->orderStatusRepository = $orderStatusRepository;
        $this->orderHistoryRepository = $orderHistoryRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->bankInfoRepository = $bankInfoRepository;
        $this->pointTracker = $pointTracker;
        $this->emailService = $emailService;
        $this->payOutConfig = Config::get('transaction.payOut');
    }
    
   /**
    * Returns the cutoff dates for payment
    *
    * @return integer[]
    */
    public function getPayOutDays()
    {
        $dates = array();
        foreach($this->payOutConfig as $config){
            array_push($dates, $config['day']);
        }
        return $dates;
        
    }
    
   /**
    * Returns next pay out date
    *
    * @param Carbon $dateNow
    * @return Carbon
    */
    public function getNextPayoutDate($dateNow = "")
    {

        $dateNow = ($dateNow !== "") ? $dateNow : Carbon::now();
        $currentDay = intval($dateNow->format('d'));
        $currentMonth = intval($dateNow->format('m'));
        $currentYear = intval($dateNow->format('Y'));

        $payOutDays = $this->getPayOutDays();
        $day = min($payOutDays);
        
        foreach($payOutDays as $payoutday){
            if ($currentDay <= $payoutday){
                $day = $payoutday;
                break;
            }            
        }

        $hasExceededLastCutOff = ($currentDay > max($payOutDays));
        $month = $currentMonth + ($hasExceededLastCutOff ? 1 : 0);
        $month = ($month > 12) ? 1 : $month;
        $year = $currentYear + (($currentMonth === 12 && $hasExceededLastCutOff) ? 1 : 0); 

        return Carbon::createFromFormat('Y-m-d', $year.'-'.$month.'-'.$day)->startOfDay();
    }
    
    
   /**
    * Returns next pay out date
    *
    * @param Carbon $dateNow
    * @return Carbon
    */
    public function getLastPayoutDate($dateNow = "")
    {
        $dateNow = ($dateNow !== "")? $dateNow : Carbon::now();
        $currentDay = intval($dateNow->format('d'));
        $currentMonth = intval($dateNow->format('m'));
        $currentYear = intval($dateNow->format('Y'));

        $payOutDays = $this->getPayOutDays();
        $day = max($payOutDays);
        
        foreach($payOutDays as $payoutday){
            if ($currentDay > $payoutday){
                $day = $payoutday;
            }            
        }
        
        $hasExceededFirstCutOff = ($currentDay > min($payOutDays));
        $month = $currentMonth - (!$hasExceededFirstCutOff ? 1 : 0);
        $month = ($month < 1) ? 12 : $month;
        $year = $currentYear - (($currentMonth === 1 && !$hasExceededFirstCutOff)?1:0  ); 
        
        return Carbon::createFromFormat('Y-m-d', $year.'-'.$month.'-'.$day)->endOfDay();
    }
    
    
   /**
    * Returns start date of the specified pay-out range
    *
    * @param Carbon dateFilter
    * @return Carbon
    */
    public function getStartPayOutRange($dateFilter = "")
    {
        $dateFilter = ($dateFilter !== "")?$dateFilter: $this->getNextPayoutDate();
        $dayFilter = intval($dateFilter->format('d'));
        $monthFilter = intval($dateFilter->format('m'));
        $yearFilter = intval($dateFilter->format('Y'));
        foreach($this->payOutConfig as $config){
            if($config['day'] === $dayFilter){
                $startDay = $config['rangeStart'];
                break;
            }
        }

        $isPreviousMonth = ($dayFilter < $startDay);
        $month = $monthFilter - ($isPreviousMonth ? 1 : 0);
        $month = ($month <= 0) ? 12 : $month;
        $year = $yearFilter - (($month === 12 && $isPreviousMonth) ? 1 : 0); 

        return Carbon::createFromFormat('Y-m-d', $year.'-'.$month.'-'.$startDay)->startOfDay();
    }
    
    
   /**
    * Returns start date of the specified pay-out range
    *
    * @param Carbon dateFilter
    * @return Carbon
    */
    public function getEndPayOutRange($dateFilter = "")
    {
        $dateFilter = ($dateFilter !== "") ? $dateFilter : $this->getNextPayoutDate();
        $dayFilter = intval($dateFilter->format('d'));
        $monthFilter = intval($dateFilter->format('m'));
        $yearFilter = intval($dateFilter->format('Y'));
        foreach($this->payOutConfig as $config){
            if($config['day'] === $dayFilter){
                $endDay = $config['rangeEnd'];
                break;
            }
        }
        
        $isEndOfMonth = $endDay === 'END_OF_MONTH';
        
        $isPreviousMonth = $isEndOfMonth || ($dayFilter < $endDay);
        $month = $monthFilter - ($isPreviousMonth ? 1 : 0);
        $month = ($month <= 0) ? 12 : $month;
        $year = $yearFilter - (($month === 12 && $isPreviousMonth) ? 1 : 0); 

        $endDay = ($isEndOfMonth)?Carbon::createFromFormat('Y-m',$year.'-'.$month)->endOfMonth()->format('d'):$endDay;

        return Carbon::createFromFormat('Y-m-d', $year.'-'.$month.'-'.$endDay)->endOfDay();
    }
    
    
    /**
     * Updates the status of a transaction to seller-paid and notifies the seller
     *
     * @param OrderProduct[] $orderProducts 
     * @param string $accountName
     * @param string $accountNumber
     * @param string $bankName
     * @return MessageBag[]
     */
    public function updateOrderProductsAsPaid($orderProducts, $accountName, $accountNumber, $bankName)
    {    
        $orderBillingInfoUpdateValidator = new OrderBillingInfoUpdateValidator( App::make('validator') );

        $orderBillingInfoUpdateValidator->with([
            'account_name' => $accountName,
            'account_number' => $accountNumber,
            'bank_name' => $bankName
        ]);
            
        
        if($orderBillingInfoUpdateValidator->passes()){
            $status = $this->orderProductStatusRepository->getSellerPaidStatus();
            foreach($orderProducts as $orderProduct){
                $orderProductId = $orderProduct->id_order_product;
                
                $sellerBillingInfo = $this->getSellerBillingInfo($orderProduct);
                if($sellerBillingInfo){
                    $orderBillingInfoId = $sellerBillingInfo->id;
                    if($sellerBillingInfo->isOrderBillingInfo){
                        $this->orderBillingInfoRepository->updateOrderBillingInfo($orderBillingInfoId, 
                                                                                    $accountName,
                                                                                    $accountNumber, 
                                                                                    $bankName);
                    }
                }
                else{
                    $this->orderBillingInfoRepository->createOrderBillingInfo($accountName, $accountNumber, $bankName);
                    $orderBillingInfoId= $this->orderBillingInfoRepository->currentId;
                }
                $this->orderProductRepository->updateOrderProductStatus($orderProduct, $status);
                $this->orderProductHistoryRepository->createOrderProductHistory($orderProductId, $status);
                
                $orderProduct->seller_billing_id = $orderBillingInfoId;
                $orderProduct->save();
            }
            
        }
        
        return $orderBillingInfoUpdateValidator->errors();
    }
    
    
    /**
     * Updates the status of a transaction to buyer-refunded
     *
     * @param OrderProduct[] $orderProducts 
     * @param string $accountName
     * @param string $accountNumber
     * @param string $bankName
     * @return MessageBag[]
     */
    public function updateOrderProductsAsRefunded($orderProducts,$accountName, $accountNumber, $bankName)
    {
        $orderBillingInfoCreateValidator = new OrderBillingInfoCreateValidator( App::make('validator') );
        
        $orderBillingInfoCreateValidator->with(
            array('account_name' => $accountName,
                'account_number' => $accountNumber,
                'bank_name' => $bankName)
        );

        if($orderBillingInfoCreateValidator->passes()){
            $status = $this->orderProductStatusRepository->getBuyerPaidStatus();
            foreach($orderProducts as $orderProduct){
                $orderProductId = $orderProduct->id_order_product;
                $this->orderBillingInfoRepository->createOrderBillingInfo($accountName, $accountNumber, $bankName);   
                $orderBillingInfoId = $this->orderBillingInfoRepository->currentId;
                $this->orderProductRepository->updateOrderProductBuyerBillingId($orderProductId, $orderBillingInfoId);
                $this->orderProductRepository->updateOrderProductStatus($orderProduct, $status);
                $this->orderProductHistoryRepository->createOrderProductHistory($orderProductId, $status);
            }
        }
    
        return $orderBillingInfoCreateValidator->errors();
        
    }
    
    /**
     * Voids an entire order
     *
     * @param integer $orderId
     * @return boolean
     */
    public function voidOrder($orderId)
    {   
        $voidStatus = OrderStatus::STATUS_VOID;
        $order = $this->orderRepository->getOrderById($orderId);
        $preVoidOrderStatus = (int) $order->order_status;
        if($preVoidOrderStatus !== $voidStatus){
            $orderProducts = $this->orderProductRepository->getOrderProductByOrderId($orderId);
            foreach($orderProducts as $orderProduct){
                $this->voidOrderProduct($orderProduct->id_order_product);
            }
            $this->orderRepository->updateOrderStatus($order, $voidStatus);
            $this->orderHistoryRepository->createOrderHistory($order->id_order, $voidStatus, 'VOIDED');
        }
        return true;
    }

    /**
     * Voids a single order product
     *
     * @param integer $orderProductId
     * @return boolean
     */
    public function voidOrderProduct($orderProductId)
    {
        $cashOnDeliveryId = intval($this->paymentMethodRepository->getCashOnDelivery());       
        $onGoingStatus = intval($this->orderProductStatusRepository->getOnGoingStatus());
        $orderProduct = $this->orderProductRepository->getOrderProductById($orderProductId);
        $orderVoidStatus = $this->orderStatusRepository->getVoidStatus();

        if(intval($orderProduct->status) === $onGoingStatus){
            if(intval($orderProduct->order->payment_method_id) === $cashOnDeliveryId){
                $voidStatus = $this->orderProductStatusRepository->getCashOnDeliveryStatus();
            }
            else{
                $voidStatus = $this->orderProductStatusRepository->getReturnBuyerStatus();
            }
            $this->orderProductRepository->updateOrderProductStatus($orderProduct, $voidStatus);
            $this->orderProductHistoryRepository->createOrderProductHistory($orderProduct->id_order_product, $voidStatus);
            $this->synchOrderStatusWithOrderProduct($orderProduct->order_id, $voidStatus,$orderVoidStatus);
            return true;
        }

        return false;
    }
    
    
    /**
     * Synch Order void status with Order Product status
     * If all order products are voided, the order will also be voided
     *
     * @param integer $orderId
     * @param integer $orderProductStatus
     * @param integer $orderStatus
     */
    public function synchOrderStatusWithOrderProduct($orderId, $orderProductStatus,$orderStatus)
    {
        $orderProducts = $this->orderProductRepository->getOrderProductByOrderId($orderId);
        $isOrderVoid = true;
        
        foreach($orderProducts as $orderProduct){
            if(intval($orderProduct->status) !== intval($orderProductStatus)){
                $isOrderVoid = false;
                break;
            }
        }
        
        if($isOrderVoid){ 
            $order = $this->orderRepository->getOrderById($orderId);
            $this->orderRepository->updateOrderStatus($order, $orderStatus);
        }
    }
    
        
    /**
     * Get the seller billing info depending on the date of purchase.
     * This is due to the change of the fk in es_order_product.seller_billing_id
     * from es_billing_info to es_order_billing_info after a certain time. This is
     * necessary so that transactions prior to the date of change remain correct.
     *
     * @param OrderProduct $orderProduct
     * @return stdObject
     */
     
    public function getSellerBillingInfo($orderProduct)
    {
        $stringBillingInfoChangeDate = Config::get('transaction.billingInfoChangeDate');
        $stringDateOfOrder = $orderProduct->order()->first()->dateadded;
        $dateOfOrder = Carbon::createFromFormat('Y-m-d H:i:s',$stringDateOfOrder);
        $billingInfoChangeDate = Carbon::createFromFormat('Y-m-d H:i:s',$stringBillingInfoChangeDate);
        $billingInfo = new \stdClass();

        if($dateOfOrder < $billingInfoChangeDate){
            $rawBillingInfo = $orderProduct->sellerBillingInfoFromBillingInfo;    
            if(!$rawBillingInfo){
                return NULL;
            }
            $billingInfo->account_name = $rawBillingInfo->bank_account_name;
            $billingInfo->account_number = $rawBillingInfo->bank_account_number;
            $billingInfo->bank_name = $rawBillingInfo->bankInfo->bank_name;
            $billingInfo->bank_id = $rawBillingInfo->bank_id;
            $billingInfo->id = $rawBillingInfo->id_billing_info;
            $billingInfo->isOrderBillingInfo = false;
        }
        else{
            $rawBillingInfo = $orderProduct->sellerBillingInfoFromOrderBillingInfo;
            if(!$rawBillingInfo){
                return NULL;
            }
            $billingInfo->account_name = $rawBillingInfo->account_name;
            $billingInfo->account_number = $rawBillingInfo->account_number;
            $billingInfo->bank_name = $rawBillingInfo->bank_name;
            
            $bankList = $this->bankInfoRepository->getAllBanks();
            $bank = $bankList->filter(function($bank) use ($rawBillingInfo)
            {
                if (strtolower($bank->bank_name) == strtolower($rawBillingInfo->bank_name)) {
                    return true;
                }
            });

            $billingInfo->bank_id = $bank->first()->id_bank; 
            $billingInfo->id = $rawBillingInfo->id_order_billing_info;
            $billingInfo->isOrderBillingInfo = true;
        }
        
        return $billingInfo;
    }
    
    /**
     * Revert order product points
     *
     * @param OrderProduct $orderProduct;
     * @return boolean
     */
    public function revertOrderPoints($orderProduct)
    {   
        $order = $orderProduct->order;
        $buyerId = $order->buyer->id_member;
        
        if($orderProduct !== null){
            $orderProductpointData = $this->orderProductRepository->getOrderProductPoint($orderProduct->id_order_product);
            $point = $orderProductpointData['point'];
            $orderProductPoint = $orderProductpointData['entity'];
            if(bccomp($point, "0") === 1 && $orderProductPoint !== null){
                $isSuccessful = $this->pointTracker->addUserPoint(
                                    $buyerId, 
                                    PointType::POINT_TYPE_REVERT, 
                                    $point
                                );
                if($isSuccessful){
                    $orderProductPoint->is_revert = OrderPoint::REVERTED;
                    $orderProductPoint->save();
                }
            }
        }
    }

    /**
     * Payout order products as paid
     *
     * @param OrderProduct[] $orderProducts
     * @param Member $member
     * @param string $accountName
     * @param string $accoutnNumber
     * @param string bankName
     * @return mixed
     */
    public function payoutOrderProducts($orderProducts, $member, $accountName, $accountNumber, $bankName)
    {     
        $payableOrderProductStatuses = [
            OrderProductStatus::STATUS_ON_GOING,
            OrderProductStatus::STATUS_FORWARD_SELLER,
        ];

        foreach($orderProducts as $key => $orderProduct){
            if( in_array( (int) $orderProduct->order_product_status->id_order_product_status,$payableOrderProductStatuses) === false){
                unset($orderProducts[$key]);
            }
        }
        
        $errors = $this->updateOrderProductsAsPaid($orderProducts, $accountName, $accountNumber, $bankName);
        $this->emailService->sendPaymentNotice($member, $orderProducts, $accountName, $accountNumber, $bankName);
        
        return [
            'errors' => $errors,
            'isSuccessful' => count($errors) > 0,
        ];
    }

    /**
     * Payout order products as paid
     *
     * @param OrderProduct[] $orderProducts
     * @param Member $member
     * @param string $accountName
     * @param string $accoutnNumber
     * @param string bankName
     * @return mixed
     */
    public function refundOrderProducts($orderProducts, $member, $accountName, $accountNumber, $bankName)
    {
        $refundableOrderProductStatuses = [
            OrderProductStatus::STATUS_RETURN_BUYER,
        ];

        foreach($orderProducts as $key => $orderProduct){
            if( in_array((int) $orderProduct->order_product_status->id_order_product_status,  $refundableOrderProductStatuses) === false ){
                unset($orderProducts[$key]);
            }
        }

        $errors = $this->updateOrderProductsAsRefunded($orderProducts, $accountName, $accountNumber, $bankName);
        foreach($orderProducts as $orderProduct){
            $this->revertOrderPoints($orderProduct);
        }
        
        $this->emailService->sendPaymentNotice($member, $orderProducts, $accountName, $accountNumber, $bankName, true);
        
        return [
            'errors' => $errors,
            'isSuccessful' => count($errors) > 0,
        ];
    }
    

}

