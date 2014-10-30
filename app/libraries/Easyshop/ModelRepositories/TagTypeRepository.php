<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use TagType;

class TagTypeRepository extends AbstractRepository
{
    /**
     * Return all tag available for seller
     * @param  boolean $default
     * @return object
     */
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

    /**
     * Return all tag available for buyers
     * @param  boolean $default [description]
     * @return object
     */
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

    /**
     * Return Contacted Tag Id
     * @return integer
     */
    public function getContacted()
    {
        return TagType::CONTACTED;
    }

    /**
     * Return Refund Tag Id
     * @return integer
     */
    public function getRefund()
    { 
        return TagType::REFUND;
    }

    /**
     * Return On-Hold Tag Id
     * @return integer
     */
    public function getOnHold()
    {
        return TagType::ON_HOLD;
    }

    /**
     * Return Payout Tag Id
     * @return integer
     */
    public function getPayOut()
    {
        return TagType::PAYOUT;
    }

    /**
     * Return Confirmed Tag Id
     * @return integer
     */
    public function getConfirmed()
    {
        return TagType::CONFIRMED;
    }
}

