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
                        {{ Form::text('stringFilter', $string, array('class' => 'form-control','placeholder' => 'Order ID/Invoice No./Transaction ID')) }}
                        <span class="input-group-addon search-btn">
                            <span class="glyphicon glyphicon-search"></span>
                        </span>                    
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
                        <td>{{{ $order->buyer->username }}}</td>
                        <td>{{{ $order->orderStatus->name }}}</td>

                        <td>{{{ $order->dateadded }}}</td>
                        <td>{{{ $order->name }}}</td>
                    </tr>
                @endforeach
            </table>
            
            {{ $orders->links() }}
            
            <button class="btn btn-default btn-sm" id='download-btn'><span class="glyphicon glyphicon-floppy-disk"></span> Download</button>

        </div>
      </div>
    
    
    
@stop


@section('page_js') 

  {{ HTML::script('js/src/jquery.datetimepicker.js') }}
  {{ HTML::script('js/transactionlist.js') }}

@stop

