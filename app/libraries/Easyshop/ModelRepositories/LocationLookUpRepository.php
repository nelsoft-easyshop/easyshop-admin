<?php namespace Easyshop\ModelRepositories;

use LocationLookUp;

class LocationLookUpRepository extends AbstractRepository
{
    public function getByType()
    {
        return LocationLookUp::whereIn('type', LocationLookUp::$TYPE)
            ->orderBy('location', 'ASC')
            ->get();
    }
}
