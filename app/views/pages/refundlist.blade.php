@extends('layouts.default')

@section('description', 'Refund List')
@section('keywords', '')
@section('title', 'Refund List | Easyshop Admin')
@section('header_tagline', 'Buyers to Refund.')

@section('page_header')
    @include('includes.header')
    <link type="text/css" href="{{{ asset('css/src/ladda/ladda-themeless.min.css')  }}}" rel="stylesheet"  media="screen"/>
    <link type="text/css" href="{{{ asset('css/src/jquery.datetimepicker.css')  }}}" rel="stylesheet"  media="screen"/>
@stop


@section('content')
  <div id="mainsection">
        <br/>
        <div class="payment_search_filter_container">

            {{ Form::open(array('url' => 'refund', 'method' => 'get')) }}

                    {{ Form::text('username', $username, array('id' => 'username', 'placeholder' => 'Storename/Username')) }}
                    
                    <label class='date-label'> From: </label for="dateFrom"> {{ Form::text('dateFrom', $dateFrom, array('class' => 'date', 'id' => 'date-from')) }}
                    <label class='date-label'> To: </label for="dateTo"> {{ Form::text('dateTo', $dateTo, array('class' => 'date', 'id' => 'date-to')) }}

                    <button id="search" class="btn">Search</button>    
            {{ Form::close() }}
            
        </div>
        
        <div class='clear'></div>
        
          
        <div class="table-responsive table-payment"> 
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Buyer</th>
                        <th>Bank</th>
                        <th>Account Name</th>
                        <th>Account No.</th>
                        <th>Email</th>
                        <th>Contact No.</th>
                        <th>NET</th>
                    </tr>
                </thead>
                
                @foreach($accountsToRefund as $account)
                    <tr class="buyer_detail" data-order-product-ids = "{{{ $account->order_product_ids }}}">
                        <td class="td_username">{{{ $account->storename }}}</td>
                        <td class="td_bankname">{{{ $account->bank_name }}} </td>
                        <td class="td_accountname">{{{ $account->account_name }}} </td>
                        <td class="td_accountno">{{{ $account->account_number }}} </td>
                        <td>{{{ $account->email }}}</td>
                        <td>{{{ $account->contactno }}}</td>
                        <td><strong>PHP {{  number_format($account->net, 2, '.', ',')  }}</strong></td>
                    </tr>
                @endforeach
            </table>
        </div>
        
  </div>
@stop


@section('page_js') 

  {{ HTML::script('js/src/jquery.datetimepicker.js') }}
  {{ HTML::script('js/src/ladda/spin.js') }}
  {{ HTML::script('js/src/ladda/ladda.js') }}
  {{ HTML::script('js/paymentlist.js') }}
  
@stop
