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
        if($isSeller){
            $bolleanTag = (count($checkTagTable) > 0) ? TRUE : FALSE;
            $currentStatus = (count($checkTagTable) > 0) ? $checkTagTable[0]->tag_type_id 
                                                         : $this->tagTypeRepository->getContacted();
            $requestForRefund = FALSE;

            if(count($checkTagTable) > 0){  
                $dateUpdated = Carbon::create(Carbon::parse($checkTagTable[0]->date_updated)->year
                                   , Carbon::parse($checkTagTable[0]->date_updated)->month
                                   , Carbon::parse($checkTagTable[0]->date_updated)->day);
                if(Carbon::now() > $dateUpdated->addDays(2) && intval($currentStatus) === $this->tagTypeRepository->getContacted()){
                    $requestForRefund = TRUE;
                }
            }

            $returnVar = array(
                        'tags' => $this->tagTypeRepository->getSellerTags($bolleanTag),
                        'current_status' => $currentStatus, 
                        'request_refund' => $requestForRefund
                    );

            return $returnVar;
        }
    }

    public function updateOrderProductTagStatus($orderId,$memberId,$tagType,$adminMemberId)
    {
        $checkTagTable = $this->orderProductTagRepository->getOrderTags($orderId,$memberId);

        // check if order product is existing then update
        if(count($checkTagTable) > 0){
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
