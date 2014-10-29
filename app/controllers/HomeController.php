<?php
class HomeController extends BaseController
{

    /**
     * Render admin dashboard page
     *
     */
    public function index()
    {
        $orderRepository = App::make('OrderProductRepository'); 
        $ungTagCount = $orderRepository->countUntagTransaction();

        return View::make('pages.dashboard')
            ->with('username', Auth::user()->username)
            ->with('unTagCount',$ungTagCount);
    }


}
