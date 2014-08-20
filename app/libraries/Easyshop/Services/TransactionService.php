<?php namespace Easyshop\Services;

use App;
use Config;
use Carbon\Carbon;
use Easyshop\Services\Validation\Laravel\OrderBillingInfoUpdateValidator;
use Easyshop\Services\Validation\Laravel\OrderBillingInfoCreateValidator;

use Easyshop\ModelRepositories\OrderProductStatusRepository as OrderProductStatusRepository;
use Easyshop\ModelRepositories\OrderBillingInfoRepository as OrderBillingInfoRepository;
use Easyshop\ModelRepositories\OrderProductRepository as OrderProductRepository;
use Easyshop\ModelRepositories\OrderProductHistoryRepository as OrderProductHistoryRepository;

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
     * Inject dependecies
     *
     */
    public function __construct(OrderProductStatusRepository $orderProductStatusRepository,
                                OrderBillingInfoRepository $orderBillingInfoRepository,
                                OrderProductRepository $orderProductRepository,
                                OrderProductHistoryRepository $orderProductHistoryRepository)    
    {
        $this->orderProductStatusRepository = $orderProductStatusRepository;
        $this->orderBillingInfoRepository = $orderBillingInfoRepository;
        $this->orderProductRepository = $orderProductRepository;
        $this->orderProductHistoryRepository = $orderProductHistoryRepository; 

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

        return Carbon::createFromFormat('Y-m-d', $year.'-'.$month.'-'.$day);
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
        
        return Carbon::createFromFormat('Y-m-d', $year.'-'.$month.'-'.$day);
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

        return Carbon::createFromFormat('Y-m-d', $year.'-'.$month.'-'.$startDay);
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

        return Carbon::createFromFormat('Y-m-d', $year.'-'.$month.'-'.$endDay);
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

        $orderBillingInfoUpdateValidator->with(
            array('account_name' => $accountName,
                'account_number' => $accountNumber,
                'bank_name' => $bankName)
        );
            
        
        if($orderBillingInfoUpdateValidator->passes()){
            $status = $this->orderProductStatusRepository->getSellerPaidStatus();
            foreach($orderProducts as $orderProduct){
                $orderProductId = $orderProduct->id_order_product;
                $orderBillingInfoId = $orderProduct->sellerBillingInfo->id_order_billing_info;
                
                $this->orderBillingInfoRepository->updateOrderBillingInfo($orderBillingInfoId, 
                                                                                $accountName,
                                                                                $accountNumber, 
                                                                                $bankName);
                $this->orderProductRepository->updateOrderProductStatus($orderProductId, $status);
                $this->orderProductHistoryRepository->createOrderProductHistory($orderProductId, $status);
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
                $this->orderProductRepository->updateOrderProductStatus($orderProductId, $status);
                $this->orderProductHistoryRepository->createOrderProductHistory($orderProductId, $status);
            }
        }
    
        return $orderBillingInfoCreateValidator->errors();
        
    }
    
    
}

