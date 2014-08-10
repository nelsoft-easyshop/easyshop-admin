<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use OrderStatus;

class OrderStatusRepository extends BaseRepository
{    
    public function getPaidStatus()
    {
        return OrderStatus::find(OrderStatus::STATUS_PAID);
    }
    
    public function getCompletedStatus()
    {
        return OrderStatus::find(OrderStatus::STATUS_COMPLETED);
    }
    
    public function getDraftStatus()
    {
        return OrderStatus::find(OrderStatus::STATUS_DRAFT);
    }

}


