<?php
class HomeController extends BaseController
{

    /**
     * Render admin dashboard page
     *
     */
    public function index()
    {
        return View::make('pages.dashboard')
            ->with('username', Auth::user()->username);
    }
    public function transactionRecord()
    {
        $userData = array(
            'startdate' => Input::get('trans_startdate'),
            'enddate' => Input::get('trans_enddate')
        );

        $orderRepository = App::make('OrderRepository');
        $transactionRecord = $orderRepository
            ->getTransactionRecord(
                Input::get('trans_startdate'),
                Input::get('trans_enddate')
            );

        $excelService = App::make('Easyshop\Services\ExcelService');
        $excelService->transactionRecord('EasyshopRecord', $transactionRecord);
    }
}
