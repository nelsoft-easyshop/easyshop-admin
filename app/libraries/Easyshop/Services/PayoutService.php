<?php 

namespace Easyshop\Services;
use Easyshop\ModelRepositories\TagTypeRepository as TagTypeRepository;
use Easyshop\ModelRepositories\OrderProductTagRepository as OrderProductTagRepository;
use Easyshop\ModelRepositories\OrderProductRepository as OrderProductRepository;
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
                                OrderProductRepository $orderProductRepository)
    {
        $this->tagTypeRepository = $tagTypeRepository;
        $this->orderProductTagRepository = $orderProductTagRepository;
        $this->orderProductRepository = $orderProductRepository;
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

    public function updateOrderProductTagStatus($orderId,$memberId,$tagType,$adminMemberId)
    {
        $checkTagTable = $this->orderProductTagRepository->getOrderTags($orderId,$memberId);

        // check if order product is existing then update
        if($checkTagTable->count() > 0){
            foreach ($checkTagTable as $orderProductTag) {
                $this->orderProductTagRepository->updateOrderTags($orderProductTag,$tagType);
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
            }
        }

        return TRUE;
    }
}
