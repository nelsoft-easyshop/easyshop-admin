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
        $orderProductRepository = App::make('OrderProductRepository'); 
        $unTaggedSellersTransaction = $orderProductRepository->getAllSellersTransaction(PHP_INT_MAX, false, [], false)->count();
        $untaggedBuyerTransactionsCount  =  $orderProductRepository->getAllSellersTransaction(PHP_INT_MAX, false, [], true)->count();

        return View::make('pages.dashboard')
            ->with('username', Auth::user()->username)
            ->with("untaggedBuyerTransactionsCount",$untaggedBuyerTransactionsCount )
            ->with('unTaggedSellersTransaction',$unTaggedSellersTransaction);
    }

}
