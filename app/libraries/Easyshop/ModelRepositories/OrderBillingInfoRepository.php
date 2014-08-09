<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use OrderBillingInfo;
use Easyshop\Services\Validation\Laravel\OrderBillingInfoUpdateValidator;

class OrderBillingInfoRepository
{    

   /**
    * Returns the Order Billing Info
    *
    * @param integer $orderBillingInfoId
    * @return Entity 
    */
    public function getOrderBillingInfoById($orderProductBillingInfoId)
    {
        return OrderBillingInfo::find($orderProductBillingInfoId);
    }

   /**
    * Updates the Order Product Billing Info
    *
    * @param integer $orderBillingInfoId
    * @param string $accountName
    * @param string $accountNumber
    * @param string $bankName
    * @return MessageBag[]
    */
    public function updateOrderBillingInfo($orderBillingInfoId, $accountName, $accountNumber, $bankName)
    {
        $data = array('order_billing_info_id' => $orderBillingInfoId, 
                    'account_name' => $accountName,
                    'account_number' => $accountNumber,
                    'bank_name' => $bankName,
                    );

        $validator = new OrderBillingInfoUpdateValidator( \App::make('validator') );
        if($validator->with($data)->passes()){
            $orderProductBillingInfo = OrderBillingInfo::find($orderBillingInfoId);
            $orderProductBillingInfo->bank_name =  $bankName;
            $orderProductBillingInfo->account_name =  $accountName;
            $orderProductBillingInfo->account_number =  $accountNumber;
            $orderProductBillingInfo->save();
        }
        

        return $validator->errors();

    }
    

}


