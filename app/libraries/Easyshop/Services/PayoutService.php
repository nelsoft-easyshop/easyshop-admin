<?php namespace Easyshop\Services;


use Easyshop\ModelRepositories\TagTypeRepository as TagTypeRepository;

class PayoutService
{
    /**
     * TagType Repository
     *
     * @var TagTypeRepository
     */
    private $tagTypeRepository;

    /**
     * Inject dependecies
     *
     */
    public function __construct(TagTypeRepository $tagTypeRepository)
    {
        $this->tagTypeRepository = $tagTypeRepository; 
    }

    public function getAvailableTags($orderId,$isSeller = TRUE)
    {
        
        if($isSeller){
            return $this->tagTypeRepository->getSellerTags();
        }
    }
}
