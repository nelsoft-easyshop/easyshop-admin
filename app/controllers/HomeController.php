<?php
use Carbon\Carbon;
class HomeController extends BaseController
{

    /**
     * Render admin dashboard page
     *
     */
    public function index()
    {
        $untaggedBuyerTransactions = 0;        
        $orderProductRepository = App::make('OrderProductRepository'); 
        $orderProductTagRepositoryRepository = App::make('OrderProductTagRepository'); 

        foreach (array_flatten($orderProductRepository->getBuyersTransactionWithShippingComment(null, null)) as $value) {
            $dt = Carbon::create(Carbon::parse($value->expected_date)->year
                                , Carbon::parse($value->expected_date)->month
                                , Carbon::parse($value->expected_date)->day);

            $exists = $orderProductTagRepositoryRepository->checkTaggerOrderProduct($value->id_order_product);
            
            if(Carbon::now() > $dt->addDays(2) && $exists < 1){
                $untaggedBuyerTransactions++;
            }
        }

        return View::make('pages.dashboard')
            ->with("untaggedBuyerTransactions",$untaggedBuyerTransactions)
            ->with('username', Auth::user()->username);
    }




}
