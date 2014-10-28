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
                TagType::CONTACTED,
                TagType::REFUND,
                TagType::ON_HOLD
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
                TagType::CONTACTED,
                TagType::PAYOUT,
                TagType::ON_HOLD
            );
        }

        return TagType::whereIn('id_tag_type', $tagArray)->get();
    }
}

