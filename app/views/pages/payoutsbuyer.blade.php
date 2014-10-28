@extends('layouts.default')

@section('description', 'Payouts - Buyer')
@section('keywords', '')
@section('title', 'Payouts - Buyer | Easyshop Admin')
@section('header_tagline', 'Payouts - Buyer.')


@section('page_header')
    @include('includes.header')
@stop


@section('content')
  <div id="mainsection">
        <br/>   

        <div class="table-responsive table-payment transaction-list"> 
        
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
                    <tr>
                        <td class='order-id'>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>
                        <td>test</td>

                        <td>test</td>
                        <td>test</td>
                    </tr>
            </table>
        </div>
      </div>
    
    
    
@stop


@section('page_js') 

  {{ HTML::script('js/src/jquery.datetimepicker.js') }}
  {{ HTML::script('js/payoutsbuyer.js') }}

@stop

