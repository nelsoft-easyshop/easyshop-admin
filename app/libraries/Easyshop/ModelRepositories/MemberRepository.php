<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use Member;
use Easyshop\Services\TransactionService as TransactionService;

class MemberRepository
{    
    
    private $transactionService;
    
   /**
    * Load dependencies through the constructor
    *
    * @param TransactionService $transactionService
    */
    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }
    
    
   /**
    *  Get users to be paid. Results are grouped by user and banking details
    *  OrderProduct->status = 1 / Payment has been cleared for transfer to seller 
    *  OrderProduct->status = 4 / Payment has been moved to the seller
    *
    *  @param string $username
    *  @param string $month
    *  @param string $year
    *  @param string $day
    *  @return Entity[] 
    */
    public function getUserAccountsToPay($username, $year, $month, $day)
    {

        if(!empty($year)  && !empty($month) && !empty($day)){
            $dateFrom =  $this->transactionService->getLastPayoutDate($year.'-'.$month.'-'.$day);
            $dateTo =  $this->transactionService>getNextPayoutDate($year.'-'.$month.'-'.$day);
        }else{
            $dateFrom =  $this->transactionService->getLastPayoutDate();
            $dateTo =  $this->transactionService->getNextPayoutDate();
        }

        $query = DB::table('es_order_product')->join('es_order_product_billing_info', 'es_order_product.id_order_product', '=', 'es_order_product_billing_info.order_product_id');
        $query ->join('es_member','es_order_product.seller_id', '=', 'es_member.id_member');
        $query ->where(function ($query) {
                    $query->where('status', '=', 1)
                        ->orWhere('status', '=', 4);
                });
        $query->where('es_order_product.created_at', '>=', $dateFrom);
        $query->where('es_order_product.created_at', '<', $dateTo);
                            
        if(!empty($username)){
            $query->where('es_member.username', '=', $username);
        }     
                                        
        $completedOrders = $query->groupBy('es_member.id_member', 'es_order_product_billing_info.bank_name',  'es_order_product_billing_info.account_name',  'es_order_product_billing_info.account_number'  )
                                ->get(['es_member.username', 'es_member.email', 'es_member.contactno', 'es_order_product_billing_info.bank_name', 'es_order_product_billing_info.account_name', 'es_order_product_billing_info.account_number', DB::raw('SUM(es_order_product.net) as net')]);
        
        return $completedOrders;
    }

}