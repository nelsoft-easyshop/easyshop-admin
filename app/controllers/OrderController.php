<?php

use Carbon\Carbon;

class OrderController extends BaseController 
{ 
    /**
     * Renders view for all valid orders
     *
     */
    public function getAllValidOrders()
    {
        
        $orderRepository = App::make('OrderRepository');
        
        if(Input::has('dateFrom')){
            $dateFrom = Carbon::createFromFormat('Y/m/d', Input::get('dateFrom'))->startOfDay();
        }   
        else{
            $dateFrom = Carbon::now()->startOfMonth()->startOfDay();
        }

        if(Input::has('dateTo')){
            $dateTo = Carbon::createFromFormat('Y/m/d', Input::get('dateTo'))->endOfDay();
        }   
        else{
           $dateTo = Carbon::now()->endOfDay();
        }
        
        if(Input::has('stringFilter') && trim(Input::get('stringFilter')) !== '' ){
            $orders = $orderRepository->getAllValidOrders($dateFrom, $dateTo, Input::get('stringFilter'));
        }
        else{
            $orders = $orderRepository->getAllValidOrders($dateFrom, $dateTo);
        }


        return View::make('pages.transactionlist')
                    ->with('orders', $orders)
                    ->with('input', Input::all());
    }

    /**
     *  GET method for displaying order details
     *
     *  @return JSON
     */
    public function getOrderDetail()
    {
        $userdata = Input::get();
        $orderRepository = App::make('OrderRepository');
        $orderProductRepository = App::make('OrderProductRepository');
        $order = $orderRepository->getOrderById($userdata['order_id']);
        
        $points = $orderRepository->getOrderPoints($order->id_order);
        $orderProducts = $orderProductRepository->getOrderProductByOrderId($userdata['order_id']);
        
        $html = View::make('partials.orderdetail')
            ->with('orderproducts', $orderProducts)
            ->with('order', $order)
            ->with('easypoints', $points)
            ->render();
        return Response::json(array('html' => $html));
    }
    
    /**
     * PUT method for voiding a transaction
     *
     * @return JSON
     */
    public function voidOrder()
    {
        $userdata = Input::get();
        $transactionService = App::make('TransactionService');
        $isSuccess = $transactionService->voidOrder($userdata['order_id']);
        
        return Response::json(array('success' => $isSuccess));
    }
    
    
}

