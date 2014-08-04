<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use BillingInfo;

use Order;

use Easyshop\Services\Validation\Laravel\BillingInfoCreateValidator;
use Easyshop\Services\Validation\Laravel\BillingInfoUpdateValidator;

class BillingInfoRepository
{    

   /**
    * Returns the payment accounts of a particular seller
    * Ordered By is_default
    * 
    * @param int $userId
    * @return Entity[]
    *
    */
    public function getBillingAccountsByMemberId($userId)
    {
        return BillingInfo::where('member_id', '=',$userId)
                            ->orderBy('is_default', 'DESC')
                            ->get();
    }
    
    
   /**
    * Updates the specified billing account
    *   
    * @param int $billingInfoId
    * @param string $accountName
    * @param string $acountNumber
    * @param int $bankId
    * @return MessageBag[]
    */
    public function updateBillingAccount($billingInfoId, $accountName, $accountNumber, $bankId)
    {            
        $validator = new BillingInfoUpdateValidator( \App::make('validator') );
        if($validator->with($data)->passes()){
            $billingInfo = BillingInfo::find($billingInfoId);
            $billingInfo->bank_account_name = $accountName;
            $billingInfo->bank_account_number = $accountNumber;
            $billingInfo->bank_id = $bankId;
            $billingInfo->save();
        }
        
        return $validator->errors();

    }
    

   /**
    * Creates a new billing account
    *
    * @param string $accountName
    * @param string $acountNumber
    * @param int $bankId
    * @return MessageBag[]
    */
    public function createBillingAccount($accountName, $accountNumber, $bankId)
    {
        $validator = new BillingInfoCreateValidator( \App::make('validator') );
        if($validator->with($data)->passes()){
            $billingInfo = new BillingInfo;
            $billingInfo->bank_account_name = $accountName;
            $billingInfo->bank_account_number = $accountNumber;
            $billingInfo->bank_id = $bankId;
            $billingInfo->save();
        }
        
        return $validator->errors();

    }


}
    