<?php namespace Easyshop\ModelRepositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Member, OrderStatus, OrderProductStatus, Product;

class MemberRepository extends AbstractRepository
{
    private $transactionService;

    /**
     * Gets the total count of users
     * @return object
     */  
    public function getUsersCount()
    {
        return DB::select(DB::raw("SELECT COUNT(*) as memberCount from `easyshop`.`es_member`"));        
    }
    /**
     * Get Number of uploaded products by users
     * @return Array
     */  
    public function getNumberOfUploadedProductsPerAccount()
    {
        $findProductOfUsers = DB::table('es_member')
                            ->leftJoin("es_product","es_product.member_id","=","es_member.id_member")
                            ->select(DB::raw("es_member.username as username, COUNT(es_product.id_product) as uploadCount"))
                            ->where("es_product.is_draft","=",0)
                            ->where("es_product.is_delete","=",0)
                            ->orderBy("uploadCount", "desc")
                            ->groupBy('username')
                            ->paginate(50);
    
        return $findProductOfUsers;
    }

    /**
     * Get Number users with and without uploaded products
     * @return Array
     */  
    public function getNumberOfUsersWithUploadedProduct()
    {
        $userCount = DB::select(DB::raw("SELECT COUNT(*) as memberCount from `easyshop`.`es_member`"));
        $usersWithUpload = DB::select(DB::raw("SELECT 
                                                COUNT(*) as userWithUpload
                                            FROM
                                                (SELECT 
                                                    m.id_member as id_member, COUNT(id_member) as idCount,COUNT(p.id_product) as uploadCount
                                                FROM
                                                    es_member m
                                                LEFT JOIN es_product p ON p.member_id = m.id_member
                                                    AND p.is_draft = 0
                                                    AND is_delete = 0
                                                GROUP BY m.username) A
                                            WHERE
                                                uploadCount > 0;
                                        "));

        $withArr[] = $usersWithUpload[0]->userWithUpload;
        $withOutArr[] = $userCount[0]->memberCount - $usersWithUpload[0]->userWithUpload;
        return array_merge($withArr,$withOutArr);
    }

    /**
     * Get number of monthly users signup
     * @return Entity
     */  
    public function getMonthlySignUp($month, $year)
    {
        foreach ($month as $key => $value) {
            $dt = Carbon::create($year, ++$key, 1);
            $signups[] = Member::whereBetween("datecreated",array((string)$dt->startOfMonth(),(string)$dt->endOfMonth()))->orderBy("datecreated","asc")->count();
        }
        return $signups;

    }

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

        return $member;
    }
    
    

 /**
     *  Get users to be paid. Results are grouped by user and banking details
     *  OrderProduct->status = 1 / Payment has been cleared for transfer to seller 
     *  OrderProduct->status = 4 / Payment has been moved to the seller
     *
     *  @param Carbon $dateFrom
     *  @param Carbon $dateTo
     *  @param string $username
     *  @return Collection
     */
    public function getUserAccountsToPay($dateFrom, $dateTo, $username = null)
    {

        $formattedDateFrom = $dateFrom->format('Y-m-d H:i:s');
        $formattedDateTo = $dateTo->format('Y-m-d H:i:s');
        
        $query = DB::table('es_order_product');
        $query->leftJoin('es_billing_info', 'es_order_product.seller_billing_id', '=', 'es_billing_info.id_billing_info');
        $query->leftJoin('es_bank_info', 'es_billing_info.bank_id', '=', 'es_bank_info.id_bank');
        $query->leftJoin('es_order_billing_info', 'es_order_product.seller_billing_id', '=', 'es_order_billing_info.id_order_billing_info');
        
        $query->join('es_member','es_order_product.seller_id', '=', 'es_member.id_member');
        $query->join('es_order','es_order_product.order_id', '=', 'es_order.id_order');
        $query->leftJoin('es_order_product_history', function($join){
            $join->on('es_order_product.id_order_product', '=', 'es_order_product_history.order_product_id');
            $join->on('es_order_product_history.order_product_status', '=',  DB::raw(OrderProductStatus::STATUS_FORWARD_SELLER));
        });
        
        $query->leftJoin('es_product_shipping_comment','es_product_shipping_comment.order_product_id', '=', 'es_order_product.id_order_product');
        $query->where(function ($query) use ($formattedDateFrom, $formattedDateTo){
            $query->where(function ($query) use ($formattedDateFrom, $formattedDateTo){
                $query->where('es_order_product_history.date_added', '>=', $formattedDateFrom);
                $query->where('es_order_product_history.date_added', '<', $formattedDateTo);
            });

            $query->orWhere(function ($query) use ($formattedDateFrom, $formattedDateTo) {
                $query->where(function ($query) {
                                $query->where('es_order.order_status', '=', OrderStatus::STATUS_PAID)
                                    ->orWhere('es_order.order_status', '=',  OrderStatus::STATUS_COMPLETED);
                            });        
                $query->where(function ($query) {
                                $query->where('es_order_product.status', '=', OrderProductStatus::STATUS_ON_GOING)
                                    ->orWhere(function ($query) {
                                            $query->where('es_order_product.status', '=', OrderProductStatus::STATUS_PAID_SELLER)
                                                  ->whereNull('es_order_product_history.id_order_product_history');
                                        }
                                    );
                            });        
                            
                $query->where('es_order_product.is_reject', '=', '0');
                $query->whereNotNull('es_product_shipping_comment.id_shipping_comment');
                $query->whereRaw("DATEDIFF(?,es_product_shipping_comment.delivery_date) >= 15");
                $query->setBindings(array_merge($query->getBindings(),array($formattedDateTo)));
                $query->whereRaw(" DATE_ADD(es_product_shipping_comment.`delivery_date`, INTERVAL 15 DAY) BETWEEN ? AND ?");
                $query->setBindings(array_merge($query->getBindings(),array($formattedDateFrom, $formattedDateTo)));
            });
        });
        
        if($username !== null){
            $query->where('es_member.username', '=', $username);
        }     
        $billingInfoChangeDate = \Config::get('transaction.billingInfoChangeDate');   
        $query->groupBy('es_member.id_member', 'es_billing_info.bank_id',  'es_billing_info.bank_account_name',  'es_billing_info.bank_account_number'  );
        $completedOrders = $query->get(['es_member.username',
                                       'es_member.email', 
                                       'es_member.contactno', 
                                        DB::raw('IF( es_order.dateadded < "'.$billingInfoChangeDate.'", es_bank_info.bank_name, es_order_billing_info.bank_name) as bank_name'), 
                                        DB::raw('IF( es_order.dateadded < "'.$billingInfoChangeDate.'", es_billing_info.bank_account_name, es_order_billing_info.account_name) as account_name'), 
                                        DB::raw('IF( es_order.dateadded < "'.$billingInfoChangeDate.'", es_billing_info.bank_account_number, es_order_billing_info.account_number) as account_number'),
                                        DB::raw('SUM(es_order_product.net) as net')
                                    ]);
                                    
        return $completedOrders;
    }

    /**
     *  Get users to be refunded. Results are grouped by user.
     *  @param Carbon $dateFrom
     *  @param Carbon $dateTo
     *  @param string $username
     *  @return Collection
     */
    public function getUserAccountsToRefund($dateFrom, $dateTo,$username = null)
    {
        $formattedDateFrom = $dateFrom->format('Y-m-d H:i:s');
        $formattedDateTo = $dateTo->format('Y-m-d H:i:s');
        
        $query = DB::table('es_order_product')->join('es_order','es_order_product.order_id', '=', 'es_order.id_order');
        $query->join('es_member','es_order.buyer_id', '=', 'es_member.id_member');
        $query->leftJoin('es_billing_info',function($leftJoin){
            $leftJoin->on('es_billing_info.member_id', '=', 'es_member.id_member');
            $leftJoin->on('es_billing_info.is_default', '=',  DB::raw('1'));
        });
        
        $query->leftJoin('es_bank_info', 'es_billing_info.bank_id', '=', 'es_bank_info.id_bank');
        $query->leftJoin('es_order_billing_info', 'es_order_product.buyer_billing_id', '=', 'es_order_billing_info.id_order_billing_info');        

        $query->join('es_order_product_history', function($join){
            $join->on('es_order_product.id_order_product', '=', 'es_order_product_history.order_product_id');
            $join->on('es_order_product_history.order_product_status', '=',  DB::raw(OrderProductStatus::STATUS_RETURN_BUYER));
        });
        $query->where(function ($query) use ($formattedDateFrom, $formattedDateTo){
            $query->where('es_order_product_history.date_added', '>=', $formattedDateFrom);
            $query->where('es_order_product_history.date_added', '<', $formattedDateTo);
        });

        if($username !== null){
            $query->where('es_member.username', '=', $username);
        }     

        $query->groupBy('es_member.id_member');
        $returnedOrders = $query->get(['es_member.username',
                                       'es_member.email', 
                                       'es_member.contactno', 
                                        DB::raw("IF( es_order_product.buyer_billing_id != '0', es_order_billing_info.bank_name, es_bank_info.bank_name) as bank_name"), 
                                        DB::raw("IF( es_order_product.buyer_billing_id != '0', es_order_billing_info.account_name, es_billing_info.bank_account_name) as account_name"), 
                                        DB::raw("IF( es_order_product.buyer_billing_id != '0', es_order_billing_info.account_number, es_billing_info.bank_account_number) as account_number"),
                                        DB::raw('SUM(es_order_product.net) as net')
                                    ]);
        
        return $returnedOrders;
    
    }

    public function search($userData,$row=50)
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
