<?php namespace Easyshop\ModelRepositories;

use BankInfo;

class BankInfoRepository
{
   /**
    * Get all available banks
    *
    * @return Entity[]
    */
    public function getAllBanks()
    {
        return BankInfo::all();
    }
     
}

