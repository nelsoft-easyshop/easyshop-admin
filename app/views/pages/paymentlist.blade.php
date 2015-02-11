@extends('layouts.default')

@section('description', 'Payment List')
@section('keywords', '')
@section('title', 'Payment List | Easyshop Admin')
@section('header_tagline', 'Seller Pay-out.')


@section('page_header')
    @include('includes.header')
    <link type="text/css" href="{{{ asset('css/src/ladda/ladda-themeless.min.css')  }}}" rel="stylesheet"  media="screen"/>
@stop


@section('content')
  <div id="mainsection">
  
        <br/>

        <div>
            <div class="payment_search_filter_container">
            
                {{ Form::open(array('url' => '/transaction/pay', 'method' => 'get')) }}

                        {{ Form::text('username', $username, array('id' => 'username', 'placeholder' => 'Storename/Username')) }}
                        
                        <select id="year" name="year">                     
                            @foreach($yearSelection as $year)
                                <option value="{{{ $year['year']  }}}" {{ ($year['selected'])?'selected':'' }}>{{{$year['year']}}}</option> 
                            @endforeach
                        </select>
                        
              
                        
                        
                        {{ Form::selectMonth('month', $defaultMonth  , ['class' => 'month', 'name' => 'month']) }}
                        <select id="day" name="day">
                            @foreach($dateSelection as $date)
                                <option value="{{{ $date['day'] }}}"  {{ ($date['selected'])?'selected':'' }}  >{{{ NumberFormatterHelper::addOrdinalNumberSuffix($date['day']) }}}</option>
                            @endforeach  
                        </select>
                        
                   
                        <button id="search" class="btn">Search</button>    
                {{ Form::close() }}
                
            </div>

            <div class="dateContainer">
                <input type="text" id="date-from" class="form-control" value="{{{ $dateFrom->format('Y/m/d') }}}" readonly="">
                <input type="text" id="date-to" class="form-control" value="{{{ $dateTo->format('Y/m/d') }}}" readonly="">
            </div>
            
        </div>
        
        <div class='clear'></div>
        
        <div class="table-responsive table-payment"> 
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Storename</th>
                        <th>Bank</th>
                        <th>Account Name</th>
                        <th>Account No.</th>
                        <th>Email</th>
                        <th>Contact No.</th>
                        <th>NET</th>
                    </tr>
                </thead>
                @foreach($accountsToPay as $account)

                    <tr class="seller_detail" data-order-product-ids = "{{{ $account->order_product_ids }}}" >
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
  
    <div class="order_dialog_con" style="display:none;">
        <div id="order_dialog_content" style=""></div>
    </div>

    
  
@stop

@section('page_js') 
  {{ HTML::script('js/paymentlist.js') }}
  {{ HTML::script('js/src/ladda/spin.js') }}
  {{ HTML::script('js/src/ladda/ladda.js') }}
@stop

