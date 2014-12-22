<?php 

namespace Easyshop\Services;
use Easyshop\ModelRepositories\TagTypeRepository as TagTypeRepository;
use Easyshop\ModelRepositories\OrderProductTagRepository as OrderProductTagRepository;
use Easyshop\ModelRepositories\OrderProductRepository as OrderProductRepository;
use Easyshop\ModelRepositories\ProductShippingCommentRepository as ProductShippingCommentRepository;
use Easyshop\ModelRepositories\OrderProductStatusRepository as OrderProductStatusRepository;
use Easyshop\ModelRepositories\OrderStatusRepository as OrderStatusRepository;
use Easyshop\ModelRepositories\OrderProductHistoryRepository as OrderProductHistoryRepository;
use Easyshop\ModelRepositories\OrderProductTagHistoryRepository as OrderProductTagHistoryRepository;
use Carbon\Carbon;

class PayoutService
{
    /**
     * TagType Repository
     *
     * @var TagTypeRepository
     */
    private $tagTypeRepository;

    /**
     * OrderProductTag Repository
     *
     * @var OrderProductTagRepository
     */
    private $orderProductTagRepository;

    /**
     * OrderProduct Repository
     *
     * @var OrderProductRepository
     */
    private $orderProductRepository;

    /**
     * OrderProduct Repository
     *
     * @var ProductShippingCommentRepository
     */
    private $productShippingCommentRepository;

    /**
     * OrderProductStatus Repository
     *
     * @var OrderProductStatusRepository
     */
    private $orderProductStatusRepository;

    /**
     * OrderProductHistory Repository
     *
     * @var OrderProductHistoryRepository
     */
    private $orderProductHistoryRepository;

    /**
     * OrderProductTagHistory Repository
     *
     * @var OrderProductTagHistoryRepository
     */
    private $orderProductTagHistoryRepository;

    /**
     * Transaction Servoce
     *
     * @var TransactionService
     */
    private $transactionService;

    /**
     * ETD (Estimated Time of Delivery) Constant days duration for orders with shipping details
     *
     * @var ETD
     */
    private $ETD = 2;

    /**
     * Inject dependecies
     *
     */
    public function __construct(TagTypeRepository $tagTypeRepository,
                                OrderProductTagRepository $orderProductTagRepository,
                                OrderProductRepository $orderProductRepository,
                                ProductShippingCommentRepository $productShippingCommentRepository,
                                OrderProductStatusRepository $orderProductStatusRepository,
                                OrderStatusRepository $orderStatusRepository,
                                OrderProductHistoryRepository $orderProductHistoryRepository,
                                OrderProductTagHistoryRepository $orderProductTagHistoryRepository,
                                TransactionService $transactionService)
    {
        $this->tagTypeRepository = $tagTypeRepository;
        $this->orderProductTagRepository = $orderProductTagRepository;
        $this->orderProductRepository = $orderProductRepository;
        $this->productShippingCommentRepository = $productShippingCommentRepository;
        $this->orderProductStatusRepository = $orderProductStatusRepository;
        $this->orderStatusRepository = $orderStatusRepository;
        $this->orderProductHistoryRepository = $orderProductHistoryRepository;
        $this->orderProductTagHistoryRepository = $orderProductTagHistoryRepository;
        $this->transactionService = $transactionService;
    }

    /**
     * Method that checks if an order has already been tagged, 
     * If not tagged, returns only CONTACTED tag
     * Else, returns tags available for buyers/sellers
     *
     * @param int $orderId
     * @param int $memberId
     * @param bool $isSeller
     * @return array
     */
    public function checkOrderProductTagStatus($orderId, $memberId, $isSeller = true)
    {
        $checkTagTable = $this->orderProductTagRepository->getOrderTags($orderId,$memberId);
        $tagCountOfOrderProducts = $checkTagTable->count();
        $hasBeenTagged = ($tagCountOfOrderProducts > 0) ? true : false;
        $currentStatus = ($tagCountOfOrderProducts > 0) ? $checkTagTable[0]->tag_type_id 
                                                     : $this->tagTypeRepository->getContacted();
        $requestType = false;

        if($tagCountOfOrderProducts > 0){  
            $dateUpdated = Carbon::create(Carbon::parse($checkTagTable[0]->date_updated)->year
                               , Carbon::parse($checkTagTable[0]->date_updated)->month
                               , Carbon::parse($checkTagTable[0]->date_updated)->day);
            if(Carbon::now() > $dateUpdated->addDays($this->ETD) && intval($currentStatus) === $this->tagTypeRepository->getContacted()){
                $requestType = true;
            }
        }
        $requestLabel = $isSeller ? 'request_refund' : 'request_payout';

        $returnVar = array(
            'tags' => ($tagsReturn = ($isSeller) ? $this->tagTypeRepository->getSellerTags($hasBeenTagged) : $this->tagTypeRepository->getBuyerTags($hasBeenTagged)),
            'current_status' => $currentStatus, 
             $requestLabel => $requestType
        );

        return $returnVar;
    }

    /**
     * Organizes the array transactionDetails to be displayed:
     * 1. checks if the order is suggested for refund/payout
     * 2. returns approriate tags for each entity(buyer/sellers) or if the entity was already contacted or not
     *
     * @param int $transactionDetails
     * @param bool $isBuyer
     *
     * @return transactionDetails
     */
    public function applyStatusOrderProductValidate(&$transactionDetails , $isBuyer)
    {
        foreach ($transactionDetails as $transaction) {
            $tagTypeId = (int)$transaction->tag_id;
            $transaction->requestForRefund = false;
            $noTagStatus = $this->tagTypeRepository->getNoTag();
            $completedStatus = (int)$this->tagTypeRepository->getContacted();
            $transaction->tagStatusAvailable = (!$isBuyer) ? $this->tagTypeRepository->getSellerTags() : $this->tagTypeRepository->getBuyerTags();

            if($tagTypeId > $noTagStatus){
                $transaction->tagStatusAvailable = (!$isBuyer) ? $this->tagTypeRepository->getSellerTags(true) : $this->tagTypeRepository->getBuyerTags(true);
                if($tagTypeId === $completedStatus){ 
                    $dateUpdated = Carbon::create(Carbon::parse($transaction->date_updated)->year
                                 , Carbon::parse($transaction->date_updated)->month
                                 , Carbon::parse($transaction->date_updated)->day);
                    if(Carbon::now() > $dateUpdated->addDays($this->ETD)){
                        $transaction->requestForRefund = true;
                    }
                }
            }
        }

        return $transactionDetails;
    }

    /**
     * Method for checking if $date is two days passed of Carbon::now()
     * @param date $date
     * @return bool
     */
    public function checkIfTwoDaysPassedofETD($date)
    {
        $dt = Carbon::create(Carbon::parse($date)->year
                            , Carbon::parse($date)->month
                            , Carbon::parse($date)->day);
        if(  Carbon::now() > $dt->addDays($this->ETD) ){
            return true;
        }
    }

    /**
     * Update order product tag status of each order product
     * @param  integer $orderId
     * @param  integer $memberId
     * @param  integer $tagType
     * @param  integer $adminMemberId
     * @return array
     */
    public function updateOrderProductTagStatus($orderId,
                                                $memberId,
                                                $tagType,
                                                $adminMemberId,
                                                $orderProductIds,
                                                $forSeller = true)
    {

        $checkTagTable = $this->orderProductTagRepository->getOrderTags($orderProductIds, $memberId);

        if($forSeller) {
            $orderProductStatus = $this->orderProductStatusRepository->getReturnBuyerStatus();
        }
        else{
            $orderProductStatus = $this->orderProductStatusRepository->getForwardSellerStatus();
        }

        $hasShippingDetails = true;
        $returnMessage = "";

        $orderStatus = $this->orderStatusRepository->getCompletedStatus();

        // check if order product is existing then update
        if($checkTagTable->count() > 0){
            if(intval($tagType) === $this->tagTypeRepository->getConfirmed()){
                foreach ($checkTagTable as $orderProductTag) {
                    $shippingInfo = $this->productShippingCommentRepository->getShippingCommentByOrderProductId($orderProductTag->order_product_id);
                    if($shippingInfo->count() <= 0){ 
                        $hasShippingDetails = false;
                        break;
                    }
                }

                if($hasShippingDetails){
                    foreach ($checkTagTable as $orderProductTag) {
                        $this->orderProductTagRepository->updateOrderTags($orderProductTag,$tagType);
                        $this->orderProductTagHistoryRepository->createOrderProductTagHistory($orderProductTag->order_product_id
                                                                                        ,$tagType
                                                                                        ,$adminMemberId);
                    }
                }
                else{
                    $hasShippingDetails = false;
                    $returnMessage = "Please complete all shipping details.";
                }
            }
            else{
                foreach ($checkTagTable as $orderProductTag) {
                    $this->orderProductTagRepository->updateOrderTags($orderProductTag,$tagType);
                    $this->orderProductTagHistoryRepository->createOrderProductTagHistory($orderProductTag->order_product_id
                                                                                    ,$tagType
                                                                                    ,$adminMemberId);

                    if($tagType == $this->tagTypeRepository->getRefund() || $tagType == $this->tagTypeRepository->getPayOut()){
                        $orderProductObject = $this->orderProductRepository->getOrderProductById($orderProductTag->order_product_id);
                        $this->orderProductRepository->updateOrderProductStatus($orderProductObject,$orderProductStatus);
                        $this->orderProductHistoryRepository->createOrderProductHistory($orderProductTag->order_product_id, $orderProductStatus);
                    }
                }

                if($tagType == $this->tagTypeRepository->getRefund() || $tagType == $this->tagTypeRepository->getPayOut()){
                    $this->transactionService->synchOrderStatusWithOrderProduct($orderId,$orderProductStatus,$orderStatus);
                }
            }
        }
        // else insert new data
        else{
            $orderProducts = $this->orderProductRepository->getManyOrderProductById($orderProductIds);
            foreach ($orderProducts as $orderProduct) {
                $this->orderProductTagRepository->insertOrderProductTag($orderProduct->id_order_product
                                                                        ,$orderProduct->seller_id
                                                                        ,$tagType
                                                                        ,$adminMemberId);

                $this->orderProductTagHistoryRepository->createOrderProductTagHistory($orderProduct->id_order_product
                                                                                    ,$tagType
                                                                                    ,$adminMemberId);
            }
        }

        return ['isSuccess' => $hasShippingDetails 
                ,'message' => $returnMessage];
    }

    /**
     * Method that adds shipping comment 
     *
     * @param array $inputData
     * @return array
     */
    public function addShippingComment($inputData)
    {   
        $booleanSuccess = false;
        $returnMessage = "";
        $expectedDate = "0000-00-00 00:00:00";

        if((int)$inputData['order_product_id'] <= 0){
            $returnMessage = "No order product will be updated.";
            return array('isSuccess'=> $booleanSuccess,'message'=>$returnMessage);
        }

        if(!$inputData['courier']){ 
            $returnMessage = "Courier cannot be empty.";
            return array('isSuccess'=> $booleanSuccess,'message'=>$returnMessage);
        }

        if(!$inputData['delivery']){ 
            $returnMessage = "Expected and Delivery Date cannot be empty.";
            return array('isSuccess'=> $booleanSuccess,'message'=>$returnMessage);
        }
        
        $deliveryDate = Carbon::createFromFormat('Y/m/d', $inputData['delivery'])->startOfDay();
        if($inputData['expected']){
            $expectedDateInput = Carbon::createFromFormat('Y/m/d', trim($inputData['expected']))->startOfDay();
            if($expectedDateInput < $deliveryDate){
                $returnMessage = "Expected date is less than in given delivery date.";
                return array('isSuccess'=> $booleanSuccess,'message'=>$returnMessage);
            }
            $expectedDate = $expectedDateInput->toDateTimeString();
        }

        $orderProduct = $this->orderProductRepository->getOrderProductById($inputData['order_product_id']);
        $memberId = $orderProduct->seller_id;
        $modifiedDate = Carbon::now();
        $insertData = $this->productShippingCommentRepository->addShippingComment($inputData['order_product_id']
                                                                    ,trim($inputData['courier'])
                                                                    ,trim($inputData['tracking'])
                                                                    ,trim($inputData['comment'])
                                                                    ,$memberId
                                                                    ,$expectedDate
                                                                    ,$deliveryDate
                                                                    ,$modifiedDate
                                                                    );
        $booleanSuccess = true;
        
        return array('isSuccess'=> $booleanSuccess,'message'=>$returnMessage);
    }
}
