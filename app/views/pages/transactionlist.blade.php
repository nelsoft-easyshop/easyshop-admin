@extends('layouts.default')

@section('description', 'Transactions List')
@section('keywords', '')
@section('title', 'Transactions List | Easyshop Admin')
@section('header_tagline', 'Transactions List.')


@section('page_header')
    @include('includes.header')
@stop


@section('content')
  <div id="mainsection">
        <br/>   

        <div class="table-responsive table-payment transaction-list"> 
        
            <div class='filter input-group input-append row'>
            
                {{ Form::open(array('url' => 'transaction', 'id' => 'transaction-form', 'method' => 'get')) }}
                
                    <div class='search-box-cont pull-left'>
                        {{ Form::text('stringFilter', $string, array('class' => 'form-control','placeholder' => 'Order ID/Invoice No./Transaction ID/Seller or Buyer Names')) }}
                        <span class="input-group-addon search-btn">
                            <span class="glyphicon glyphicon-search"></span>
                        </span>                    
                    </div>
                                
                    <div class='filter-content pull-left'>
                        {{ Form::hidden('orderStatus', $selectedOrderStatus, array('id' => 'order-status-value')) }}
                        {{ Form::hidden('paymentMethod', $selectedPaymentMethod, array('id' => 'payment-method-value')) }}
                        <div class="btn-group">
                            <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                <span id="order-status-title">Order Status</span>
                                <span class="caret"></span>
                            </a>
                            <ul id="order-status-list" class="dropdown-menu" role="menu">
                                <li role="presentation" class="dropdown-header">Filter by :</li>
                                <li><a data-value="all" href="javascript:void(0)">ALL</a></li>
                                @foreach($orderStatus as $status)
                                    <li><a data-value="{{{ $status->order_status }}}" href="javascript:void(0)">{{{ $status->name }}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                <span id="payment-method-title">Payment Method</span>
                                <span class="caret"></span>
                            </a>
                            <ul id="payment-method-list" class="dropdown-menu" role="menu">
                                <li role="presentation" class="dropdown-header">Filter by :</li>
                                <li><a data-value="all" href="javascript:void(0)">ALL</a></li>
                                @foreach($paymentMethods as $method)
                                    <li><a data-value="{{{ $method->id_payment_method }}}" href="javascript:void(0)">{{{ $method->name }}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                                
                    <div class='date-cont pull-right'>
                            {{ Form::text('dateFrom', $dateFrom, array('class' => 'date form-control pull-left','placeholder' => 'Start Date', 'id' => 'date-from')) }}
                            {{ Form::text('dateTo', $dateTo, array('class' => 'date form-control pull-right', 'placeholder' => 'End Date', 'id' => 'date-to')) }}
                    </div>
                    <input type="submit" class="out-of-screen"/>
                
                {{ Form::close() }}
                
            </div>
            
            <table class="table table-striped table-hover">
                <thead>
                     <tr>
                        <th>Order ID</th>
                        <th>Invoice No</th>
                        <th>Transaction ID</th>
                        <th>Total Amount</th>
                        <th>Buyer</th>
                        <th>Status</th>
                        <th>Date of Transaction</th>
                        <th>Type of Payment Method</th>
                     </tr>
                </thead>

                @foreach($orders as $order) 
                    <tr>
                        <td class='order-id'>{{{ $order->id_order }}}</td>
                        <td>{{{ $order->invoice_no }}}</td>
                        <td>{{{ $order->transaction_id }}}</td>
                        <td>PHP {{{ $order->total }}}</td>
                        <td>{{{ $order->buyer->getStoreName() }}}</td>
                        <td>{{{ $order->orderStatus->name }}}</td>

                        <td>{{{ $order->dateadded }}}</td>
                        <td>{{{ $order->name }}}</td>
                    </tr>
                @endforeach
            </table>
            
            {{ $orders->appends(array('dateFrom' => $dateFrom, 'dateTo' => $dateTo, 'stringFilter' => $string))->links() }}
            
            <button class="btn btn-default btn-sm" id='download-btn'><span class="glyphicon glyphicon-floppy-disk"></span> Download</button>

        </div>
      </div>
      
      <input type="hidden" value="{{{ $userid }}}" id="userid"/>
      <input type="hidden" value="{{{ $webserviceUrl }}}" id="webserviceUrl"/>
    
@stop


@section('page_js') 

  {{ HTML::script('js/src/jquery.datetimepicker.js') }}
  {{ HTML::script('js/transactionlist.js') }}

@stop

