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

        $orderRepository = App::make('OrderProductRepository'); 
        $unTaggedSellersTransactionCount = $orderRepository->countUntagTransaction();
        $untaggedBuyerTransactionsCount  = $orderRepository->countUntagTransaction(FALSE);

        return View::make('pages.dashboard')
            ->with('username', Auth::user()->username)
            ->with("untaggedBuyerTransactionsCount",$untaggedBuyerTransactionsCount )
            ->with('unTaggedSellersTransactionCount',$unTaggedSellersTransactionCount);

    }




}
