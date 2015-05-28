<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use OrderStatus;

class OrderStatusRepository extends AbstractRepository
{    
    public function getPaidStatus()
    {
        return OrderStatus::STATUS_PAID;
    }
    
    public function getCompletedStatus()
    {
        return OrderStatus::STATUS_COMPLETED;
    }
    
    public function getVoidStatus()
    {
        return OrderStatus::STATUS_VOID;
    }
    
    
    public function getDraftStatus()
    {
        return OrderStatus::STATUS_DRAFT;
    }

    /**
     * Get all order status
     * @return OrderStatus[]
     */
    public function getAllStatus()
    {
        return OrderStatus::all();
    }
}


