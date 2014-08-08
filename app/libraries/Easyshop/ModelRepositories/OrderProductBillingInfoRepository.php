<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use OrderProductBillingInfo;
use Easyshop\Services\Validation\Laravel\OrderProductBillingInfoUpdateValidator;

class OrderProductBillingInfoRepository
{    

   /**
    * Returns the Order Product Billing Info
    *
    * @param integer $orderProductBillingInfoId
    * @return Entity 
    */
    public function getOrderProductBillingInfoById($orderProductBillingInfoId)
    {
        return OrderProductBillingInfo::find($orderProductBillingInfoId);
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
    public function updateOrderProductBillingInfo($orderBillingInfoId, $accountName, $accountNumber, $bankName)
    {
        $data = array('order_billing_info_id' => $orderBillingInfoId, 
                    'account_name' => $accountName,
                    'account_number' => $accountNumber,
                    'bank_name' => $bankName,
                    );

        $validator = new OrderProductBillingInfoUpdateValidator( \App::make('validator') );
        if($validator->with($data)->passes()){
            $orderProductBillingInfo = OrderProductBillingInfo::find($orderBillingInfoId);
            $orderProductBillingInfo->bank_name =  $bankName;
            $orderProductBillingInfo->account_name =  $accountName;
            $orderProductBillingInfo->account_number =  $accountNumber;
            $orderProductBillingInfo->save();
        }
        

        return $validator->errors();

    }
    

}


