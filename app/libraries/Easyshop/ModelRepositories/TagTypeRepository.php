<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use TagType;

class TagTypeRepository extends AbstractRepository
{
    public function getSellerTags($default = false)
    {
        $tagArray = array(
                TagType::CONTACTED 
            );

        if($default){
            $tagArray = array( 
                TagType::CONFIRMED,
                TagType::ON_HOLD,
                TagType::REFUND,
            );
        }

        return TagType::whereIn('id_tag_type', $tagArray)->get();
    }

    public function getBuyerTags($default = false)
    {
        $tagArray = array(
                        TagType::CONTACTED 
                    );

        if($default){
            $tagArray = array( 
                TagType::REFUND,
                TagType::ON_HOLD
            );
        }

        return TagType::whereIn('id_tag_type', $tagArray)->get();
    }

    public function getContacted()
    {
        return TagType::CONTACTED;
    }

    public function getRefund()
    { 
        return TagType::REFUND;
    }

    public function getOnHold()
    {
        return TagType::ON_HOLD;
    }

    public function getPayOut()
    {
        return TagType::PAYOUT;
    }

    public function getConfirmed()
    {
        return TagType::CONFIRMED;
    }
}

