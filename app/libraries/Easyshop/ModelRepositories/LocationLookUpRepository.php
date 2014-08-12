<?php namespace Easyshop\ModelRepositories;

use LocationLookUp;

class LocationLookUpRepository
{
    public function getByType()
    {
        $type = array(
            '0' => 0,
            '1' => 3,
            '2' => 4
        );

        return LocationLookUp::whereIn('type', $type)
            ->orderBy('location', 'ASC')
            ->get();
    }
}
