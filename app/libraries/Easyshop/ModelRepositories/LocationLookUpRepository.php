<?php namespace Easyshop\ModelRepositories;

use LocationLookUp;

class LocationLookUpRepository
{
    public function getLocationLookUpByType($type)
    {
        return LocationLookUp::whereIn('type',$type)->orderBy('location','ASC')->get();
    }
}

