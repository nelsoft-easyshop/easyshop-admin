<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use Member;
use Carbon\Carbon;
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
             $dateFilter = Carbon::createFromFormat('Y-m-d', $year.'-'.$month.'-'.$day);
        }else{
             $dateFilter = $this->transactionService->getNextPayoutDate();
        }

        $dateFrom = $this->transactionService->getStartPayOutRange($dateFilter)->format('Y-m-d');
        $dateTo = $this->transactionService->getEndPayOutRange($dateFilter)->format('Y-m-d');
        
        $query = DB::table('es_order_product')->join('es_order_product_billing_info', 'es_order_product.id_order_product', '=', 'es_order_product_billing_info.order_product_id');
        $query->join('es_member','es_order_product.seller_id', '=', 'es_member.id_member');
        $query->join('es_order','es_order_product.order_id', '=', 'es_order.id_order');
        $query->leftJoin('es_product_shipping_comment','es_product_shipping_comment.order_product_id', '=', 'es_order_product.id_order_product');
        $query->where(function ($query) use ($dateFrom, $dateTo){
          
            $query->where(function ($query) {
              
                            $query->where('status', '=', OrderProductRepository::STATUS_FUND_CLEARED)
                                ->orWhere('status', '=', OrderProductRepository::STATUS_FUND_MOVED);
                        });
            $query->where('es_order_product.created_at', '>=', $dateFrom);
            $query->where('es_order_product.created_at', '<', $dateTo);
        });

        $query->orWhere(function ($query) use ($dateFrom, $dateTo) {
            $query->where(function ($query) {
                            $query->where('es_order.order_status', '=', OrderRepository::STATUS_PAID)
                                ->orWhere('es_order.order_status', '=',  OrderRepository::STATUS_COMPLETED);
                        });
            $query->where('es_order_product.status', '=', OrderProductRepository::STATUS_ON_GOING);
            $query->where('es_order_product.is_reject', '=', '0');
            $query->whereNotNull('es_product_shipping_comment.id_shipping_comment');
            $query->where(DB::raw("DATEDIFF(?,es_product_shipping_comment.delivery_date) >= 15"));
            $query->setBindings(array_merge($query->getBindings(),array($dateTo)));
            $query->where(DB::raw(" DATE_ADD(es_product_shipping_comment.`delivery_date`, INTERVAL 15 DAY) BETWEEN ? AND ?"));
            $query->setBindings(array_merge($query->getBindings(),array($dateFrom, $dateTo)));

        });
        
        if(!empty($username)){
            $query->where('es_member.username', '=', $username);
        }     
                                        
        $completedOrders = $query->groupBy('es_member.id_member', 'es_order_product_billing_info.bank_name',  'es_order_product_billing_info.account_name',  'es_order_product_billing_info.account_number'  )
                                ->get(['es_member.username', 'es_member.email', 'es_member.contactno', 'es_order_product_billing_info.bank_name', 'es_order_product_billing_info.account_name', 'es_order_product_billing_info.account_number', DB::raw('SUM(es_order_product.net) as net')]);
        
        return $completedOrders;
    }

}