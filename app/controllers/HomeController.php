<?php
class HomeController extends BaseController
{
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
        $transactionRecord = $orderRepository->getTransactionRecord($userData);

        $excelService = App::make('Easyshop\Services\ExcelService');
        $excelService->transactionRecord('EasyshopRecord', $transactionRecord);
    }
}
