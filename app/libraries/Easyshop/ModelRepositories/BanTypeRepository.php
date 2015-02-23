<?php namespace Easyshop\ModelRepositories;

use BanType;

class BanTypeRepository extends AbstractRepository
{
    public function getByType()
    {
        return BanType::whereIn('id_ban_type', BanType::$TITLE)
            ->get();
    }
}
