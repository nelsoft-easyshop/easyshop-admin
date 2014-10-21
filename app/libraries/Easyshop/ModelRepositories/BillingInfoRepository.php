<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use BillingInfo;
use Order;

class BillingInfoRepository extends AbstractRepository
{    
    
    /**
     * Returns the payment accounts of a particular seller
     * Ordered By is_default
     * 
     * @param int $userId
     * @return BillingInfo[]
     *
     */
    public function getBillingAccountsByMemberId($userId)
    {
        return BillingInfo::where('member_id', '=',$userId)
                            ->orderBy('is_default', 'DESC')
                            ->get();
    }
    
    /**
     * Returns the BillingInfo id
     *
     * @param int $billingInfoId
     * @return BillingInfo[]
     */
    public function getBillingAccountById($billingInfoId)
    {
        return BillingInfo::find($billingInfoId);
    }
    
    /**
     * Updates the specified billing account
     *   
     * @param int $billingInfoId
     * @param string $accountName
     * @param string $acountNumber
     * @param int $bankId
     * @return boolean
     */
    public function updateBillingAccount($billingInfoId, $accountName, $accountNumber, $bankId, $memberId)
    {            
        $billingInfo = BillingInfo::where('id_billing_info', '=',$billingInfoId)
                                    ->where('member_id', '=',$memberId)->first();         
        $billingInfo->bank_account_name = $accountName;
        $billingInfo->bank_account_number = $accountNumber;
        $billingInfo->bank_id = $bankId;
        $billingInfo->datemodified = date('Y-m-d H:i:s');
        $isSuccessful = $billingInfo->save();
        
        $this->currentId = $billingInfo->id_billing_info;
        
        return $isSuccessful;
    }
    

    /**
     * Creates a new billing account
     *
     * @param string $accountName
     * @param string $acountNumber
     * @param int $bankId
     * @return boolean
     */
    public function createBillingAccount($accountName, $accountNumber, $bankId, $memberId)
    {
    
        $billingInfo = new BillingInfo;
        $billingInfo->bank_account_name = $accountName;
        $billingInfo->bank_account_number = $accountNumber;
        $billingInfo->member_id = $memberId;
        $billingInfo->bank_id = $bankId;
        
        $billingInfo->dateadded = date('Y-m-d H:i:s');
        $billingInfo->datemodified = date('Y-m-d H:i:s');
        
        if($this->getDefaultAccount($memberId)->isEmpty()){
            $billingInfo->is_default = 1;
        }
        else{
            $billingInfo->is_default = 0;
        }
        
        $isSuccessful = $billingInfo->save();
        
        $this->currentId = $billingInfo->id_billing_info;
        
        return $isSuccessful;

    }
    
    
    /**
     * Return the default account for a particular member
     *
     * @param integer $userId
     * @return BillingInfo
     */
    public function getDefaultAccount($userId)
    {
        $defaultAccount = BillingInfo::where('member_id', '=',$userId)
                                    ->where('is_default', '=', DB::raw('1'))
                                    ->get();
        return $defaultAccount;
        
    }



}
    