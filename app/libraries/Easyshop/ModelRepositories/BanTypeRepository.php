<?php namespace Easyshop\ModelRepositories;

use BanType;

class BanTypeRepository extends AbstractRepository
{

    /**
     * Gets the Ban type by type
     * @return mixed
     */
    public function getByType()
    {
        $banTypes = [
            BanType::BAN_TYPE_PAYPAL_DISPUTE,
            BanType::BAN_TYPE_INQUIRY_NONCOMPLIANCE
        ];

        return BanType::whereIn('id_ban_type', $banTypes)->get();
    }

}
