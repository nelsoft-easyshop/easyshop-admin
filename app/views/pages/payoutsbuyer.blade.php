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
                        <th>Order Product ID</th>
                        <th>Username</th>
                        <th>Number of Products</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                     </tr>
                </thead>
                @foreach($orders as $key => $details)
                    <tr class='buyer-list'>
                        <td class='td_order_id'>{{{$details->id_order}}}</td>
                        <td class='td_order_id'>{{{$details->id_order_product}}}</td>
                        <td class='username'>{{{$details->username}}}</td>
                        <td class='count'>{{{$details->count}}}</td>
                        <td class='email'>{{{$details->email}}}</td>
                        <td class="contactno">{{{ ($details->contactno) ? $details->contactno : 'N/A' }}}</td>                        
                    </tr>
                @endforeach
            </table>
        </div>
      </div>
    
    
    
@stop


@section('page_js') 

  {{ HTML::script('js/src/jquery.datetimepicker.js') }}
  {{ HTML::script('js/payoutsbuyer.js') }}

@stop

