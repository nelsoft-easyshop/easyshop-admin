<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use OrderBillingInfo;

class OrderBillingInfoRepository extends AbstractRepository
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
     * @return Boolean
     */
    public function updateOrderBillingInfo($orderBillingInfoId, $accountName, $accountNumber, $bankName)
    {
        $orderProductBillingInfo = OrderBillingInfo::find($orderBillingInfoId);
        $orderProductBillingInfo->bank_name =  $bankName;
        $orderProductBillingInfo->account_name =  $accountName;
        $orderProductBillingInfo->account_number =  $accountNumber;
        $isSuccessful = $orderProductBillingInfo->save();
        
        $this->currentId = $orderProductBillingInfo->id_order_billing_info;
        
        return $isSuccessful;

    }
        
        
    /**
     * Inserts new Order Product Billing Info
     *
     * @param string $accountName
     * @param string $accountNumber
     * @param string $bankName
     * @return Boolean
     */
    public function createOrderBillingInfo($accountName, $accountNumber, $bankName)
    {
        $orderProductBillingInfo = new OrderBillingInfo;
        $orderProductBillingInfo->bank_name =  $bankName;
        $orderProductBillingInfo->account_name =  $accountName;
        $orderProductBillingInfo->account_number =  $accountNumber;
        $isSuccessful = $orderProductBillingInfo->save();
        
        $this->errors = $orderProductBillingInfo->errors();
        $this->currentId = $orderProductBillingInfo->id_order_billing_info;
        
        return $isSuccessful;
        
    }

}


