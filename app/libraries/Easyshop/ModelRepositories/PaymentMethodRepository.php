<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use PaymentMethod;

class PaymentMethodRepository extends AbstractRepository
{    
    public function getPaypal()
    {
        return PaymentMethod::PAYPAL;
    }
    
    public function getDragonPay()
    {
        return PaymentMethod::DRAGONPAY;
    }
    
    public function getCashOnDelivery()
    {
        return PaymentMethod::COD;
    }

    public function getDirectBank()
    {
        return PaymentMethod::DIRECTBANK;
    }

}


