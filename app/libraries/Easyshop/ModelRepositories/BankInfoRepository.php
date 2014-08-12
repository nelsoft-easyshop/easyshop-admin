<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use BankInfo;

class BankInfoRepository extends BaseRepository
{
    /**
     * Get all available banks
     *
     * @return BankInfo[]
     */
    public function getAllBanks()
    {
        return BankInfo::all();
    }
     
}

