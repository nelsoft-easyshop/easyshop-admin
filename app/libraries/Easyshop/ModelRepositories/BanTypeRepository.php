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
        return BanType::where('id_ban_type','<>', BanType::NOT_BANNED)->get();
    }

}
