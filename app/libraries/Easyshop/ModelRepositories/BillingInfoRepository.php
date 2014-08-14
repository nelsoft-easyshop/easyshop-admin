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
        $billingInfo->is_default = $this->hasDefaultAccount($memberId) ? '0' : '1';
        $isSuccessful = $billingInfo->save();
        
        $this->currentId = $billingInfo->id_billing_info;
        
        return $isSuccessful;

    }
    
    
    /**
     * Return whether a default account exists for a particular member
     *
     * @param integer $userId
     * @return boolean
     */
    public function hasDefaultAccount($userId){
        $defaultAccount = BillingInfo::where('member_id', '=',$userId)
                    ->where('is_default', '=', DB::raw('1'))
                    ->get();
        return !$defaultAccount->isEmpty();
        
    }



}
    