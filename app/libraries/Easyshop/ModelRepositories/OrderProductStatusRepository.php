<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use OrderProductStatus;

class OrderProductStatusRepository extends AbstractRepository
{    
    public function getOnGoingStatus()
    {
        return OrderProductStatus::STATUS_ON_GOING;
    }
    
    public function getForwardSellerStatus()
    {
        return OrderProductStatus::STATUS_FORWARD_SELLER;
    }
    
    public function getReturnBuyerStatus()
    {
        return OrderProductStatus::STATUS_RETURN_BUYER;
    }
    
    public function getCashOnDeliveryStatus()
    {
        return OrderProductStatus::STATUS_COD;
    }
    
    public function getSellerPaidStatus()
    {
        return OrderProductStatus::STATUS_PAID_SELLER;
    }
    
    public function getBuyerPaidStatus()
    {
        return OrderProductStatus::STATUS_PAID_BUYER;
    }
    
    public function getCancelStatus()
    {
        return OrderProductStatus::STATUS_CANCEL;
    }
  
}


