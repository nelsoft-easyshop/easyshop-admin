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
     * ETD (Estimated Time of Delivery) Constant duration for orders with shipping details
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

    public function checkOrderProductTagStatus($orderId,$memberId,$isSeller = TRUE)
    {   

        $checkTagTable = $this->orderProductTagRepository->getOrderTags($orderId,$memberId);

        $bolleanTag = ($checkTagTable->count() > 0) ? TRUE : FALSE;
        $currentStatus = ($checkTagTable->count() > 0) ? $checkTagTable[0]->tag_type_id 
                                                     : $this->tagTypeRepository->getContacted();
        $requestType = FALSE;

        if($checkTagTable->count() > 0){  
            $dateUpdated = Carbon::create(Carbon::parse($checkTagTable[0]->date_updated)->year
                               , Carbon::parse($checkTagTable[0]->date_updated)->month
                               , Carbon::parse($checkTagTable[0]->date_updated)->day);
            if(Carbon::now() > $dateUpdated->addDays(2) && intval($currentStatus) === $this->tagTypeRepository->getContacted()){
                $requestType = TRUE;

            }
        }
        $requestLabel = ($isSeller) ? 'request_refund' : 'request_payout';

        $returnVar = array(
            'tags' => ($tagsReturn = ($isSeller) ? $this->tagTypeRepository->getSellerTags($bolleanTag) : $this->tagTypeRepository->getBuyerTags($bolleanTag)),
            'current_status' => $currentStatus, 
             $requestLabel => $requestType
        );

        return $returnVar;
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
     * @param  [type] $orderId       [description]
     * @param  [type] $memberId      [description]
     * @param  [type] $tagType       [description]
     * @param  [type] $adminMemberId [description]
     * @return [type]                [description]
     */
    public function updateOrderProductTagStatus($orderId,$memberId,$tagType,$adminMemberId)
    {
        $checkTagTable = $this->orderProductTagRepository->getOrderTags($orderId,$memberId);
        $booleanReturn = TRUE;
        $returnMessage = "";
        $orderProductStatus = $this->orderProductStatusRepository->getReturnBuyerStatus();
        $orderStatus = $this->orderStatusRepository->getCompletedStatus();

        // check if order product is existing then update
        if($checkTagTable->count() > 0){
            if(intval($tagType) === $this->tagTypeRepository->getConfirmed()){
                foreach ($checkTagTable as $orderProductTag) {
                    $shippingInfo = $this->productShippingCommentRepository->getShippingCommentByOrderProductId($orderProductTag->order_product_id);
                    if($shippingInfo->count() <= 0){ 
                        $booleanReturn = FALSE;
                        break;
                    }
                }

                if($booleanReturn){
                    foreach ($checkTagTable as $orderProductTag) {
                        $this->orderProductTagRepository->updateOrderTags($orderProductTag,$tagType);
                        $this->orderProductTagHistoryRepository->createOrderProductTagHistory($orderProductTag->order_product_id
                                                                                        ,$tagType
                                                                                        ,$adminMemberId);
                    }
                }
                else{
                    $booleanReturn = FALSE;
                    $returnMessage = "Please complete all shipping details.";
                }
            }
            else{
                foreach ($checkTagTable as $orderProductTag) {
                    $this->orderProductTagRepository->updateOrderTags($orderProductTag,$tagType);
                    $this->orderProductTagHistoryRepository->createOrderProductTagHistory($orderProductTag->order_product_id
                                                                                    ,$tagType
                                                                                    ,$adminMemberId);

                    if($tagType == $this->tagTypeRepository->getRefund()){
                        $orderProductObject = $this->orderProductRepository->getOrderProductById($orderProductTag->order_product_id);
                        $this->orderProductRepository->updateOrderProductStatus($orderProductObject,$orderProductStatus);
                        $this->orderProductHistoryRepository->createOrderProductHistory($orderProductTag->order_product_id, $orderProductStatus);
                    }
                }

                if($tagType == $this->tagTypeRepository->getRefund()){
                    $this->transactionService->synchOrderStatusWithOrderProduct($orderId,$orderProductStatus,$orderStatus);
                }
            }
        }
        // else insert new data
        else{
            $orderProducts = $this->orderProductRepository->getOrderProductByOrderId($orderId,$memberId);
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

        return ['isSuccess' => $booleanReturn 
                ,'message' => $returnMessage];
    }

    public function addShippingComment($inputData)
    {   
        $booleanSuccess = FALSE;
        $returnMessage = "";

        if(intval($inputData['order_product_id']) <= 0){
            $returnMessage = "No order product will be updated.";

            return array('isSuccess'=> $booleanSuccess,'message'=>$returnMessage);
        }

        if(trim($inputData['courier']) === ""){ 
            $returnMessage = "Courier cannot be empty.";

            return array('isSuccess'=> $booleanSuccess,'message'=>$returnMessage);
        }

        if(trim($inputData['delivery']) === "" ){ 
            $returnMessage = "Expected and Delivery Date cannot be empty.";

            return array('isSuccess'=> $booleanSuccess,'message'=>$returnMessage);
        }
        else{ 
            $deliveryDate = Carbon::createFromFormat('Y/m/d', $inputData['delivery'])->startOfDay();
            if(trim($inputData['expected']) !== ""){
                $expectedDate = Carbon::createFromFormat('Y/m/d', $inputData['expected'])->startOfDay();
                if($expectedDate < $deliveryDate){
                    $returnMessage = "Expected date is less than in given delivery date.";

                    return array('isSuccess'=> $booleanSuccess,'message'=>$returnMessage);
                }
            }
            else{
                $expectedDate = "";
            }

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
        $booleanSuccess = TRUE;
        $returnMessage = "";
        
        return array('isSuccess'=> $booleanSuccess,'message'=>$returnMessage);
    }
}
