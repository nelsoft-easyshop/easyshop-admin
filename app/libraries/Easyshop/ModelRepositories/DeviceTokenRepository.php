<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use DeviceToken;

class DeviceTokenRepository extends AbstractRepository
{
    /**
     * Return all device token avaialable and active in database
     * @param  integer $apiType
     * @return object
     */
    public function getActiveDeviceTokens($apiType)
    { 
        return DeviceToken::where('api_type', $apiType)
                            ->where('is_active', true)
                            ->get();
    }
}

