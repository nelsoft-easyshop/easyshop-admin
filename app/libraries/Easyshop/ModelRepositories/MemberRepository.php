<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use Member, OrderStatus, OrderProductStatus;

class MemberRepository extends AbstractRepository
{
    private $transactionService;

    /**
     * Update the member entity
     *
     * @param $member object
     * @param $data
     */
    public function update($member, $data)
    {
        return $member->update($data);
    }
        
    /**
     * Return member by id
     *
     * @param int $memberId
     * @return Member
     */
    public function getById($memberId)
    {
        $member = Member::with('address')
            ->find($memberId);
        $member->Address->City;
        $member->Address->Region;

        return $member;
    }
    
    

    /**
     *  Get users to be paid. Results are grouped by user and banking details
     *  OrderProduct->status = 1 / Payment has been cleared for transfer to seller 
     *  OrderProduct->status = 4 / Payment has been moved to the seller
     *
     *  @param string $username
     *  @param Carbon $dateFrom
     *  @param Carbon $dateTo
     *  @return Collection
     */
    public function getUserAccountsToPay($username, $dateFrom, $dateTo)
    {

        $dateFrom = $dateFrom->format('Y-m-d');
        $dateTo = $dateTo->format('Y-m-d');
        
        $query = DB::table('es_order_product')->leftJoin('es_order_billing_info', 'es_order_product.seller_billing_id', '=', 'es_order_billing_info.id_order_billing_info');
        $query->join('es_member','es_order_product.seller_id', '=', 'es_member.id_member');
        $query->join('es_order','es_order_product.order_id', '=', 'es_order.id_order');
        $query->join('es_order_product_history', function($join){
            $join->on('es_order_product.id_order_product', '=', 'es_order_product_history.order_product_id');
            $join->on('es_order_product_history.order_product_status', '=',  DB::raw(OrderProductStatus::STATUS_FORWARD_SELLER));
        });
        
        $query->leftJoin('es_product_shipping_comment','es_product_shipping_comment.order_product_id', '=', 'es_order_product.id_order_product');
        $query->where(function ($query) use ($dateFrom, $dateTo){
            $query->where('es_order_product_history.created_at', '>=', $dateFrom);
            $query->where('es_order_product_history.created_at', '<', $dateTo);
        });

        $query->orWhere(function ($query) use ($dateFrom, $dateTo) {
            $query->where(function ($query) {
                            $query->where('es_order.order_status', '=', OrderStatus::STATUS_PAID)
                                ->orWhere('es_order.order_status', '=',  OrderStatus::STATUS_COMPLETED);
                        });
            $query->where('es_order_product.status', '=', OrderProductStatus::STATUS_ON_GOING);
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
                                        
        $completedOrders = $query->groupBy('es_member.id_member', 'es_order_billing_info.bank_name',  'es_order_billing_info.account_name',  'es_order_billing_info.account_number'  )
                                ->get(['es_member.username', 'es_member.email', 'es_member.contactno', 'es_order_billing_info.bank_name', 'es_order_billing_info.account_name', 'es_order_billing_info.account_number', DB::raw('SUM(es_order_product.net) as net')]);

        
        return $completedOrders;
    }

    public function search($userData,$row)
    {
        $member = Member::groupBy('es_member.id_member');
        if($userData['fullname']){
            $member->where('es_member.fullname', 'LIKE', '%' . $userData['fullname'] . '%');
        }
        if($userData['username']){
            $member->where('es_member.username', 'LIKE', '%' . $userData['username'] . '%');
        }
        if($userData['contactno']){
            $member->where('es_member.contactno', 'LIKE', '%' . $userData['contactno'] . '%');
        }
        if($userData['email']){
            $member->where('es_member.email', 'LIKE', '%' . $userData['email'] . '%');
        }
        if(($userData['startdate']) && ($userData['enddate'])){
            $member->where('es_member.datecreated', '>=', str_replace('/', '-', $userData['startdate']) . ' 00:00:00' )
                ->where('es_member.datecreated', '<=', str_replace('/', '-', $userData['enddate']) . ' 23:59:59', 'AND');
        }

        return $member->paginate($row);
    }
}
