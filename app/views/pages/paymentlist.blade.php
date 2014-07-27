@extends('layouts.default')

@section('description', 'Payment List')
@section('keywords', '')
@section('title', 'Payment List | Easyshop Admin')
@section('header_tagline', 'Payment List.')


@section('page_header')
    @include('includes.header')
@stop


@section('content')
  <div id="mainsection">
  
        <br/>

        <div class="payment_search_filter_container">
        
            {{ Form::open(array('url' => 'pay', 'method' => 'get')) }}
 

                    {{ Form::text('username', $username, array('id' => 'username', 'placeholder' => 'Username')) }}
                    
                    <select id="year" name="year">                     
                        @foreach($yearSelection as $year)
                            <option value="{{{ $year['year']  }}}" {{ ($year['selected'])?'selected':'' }}>{{{$year['year']}}}</option> 
                        @endforeach
                    </select>
                    
                    {{ Form::selectMonth('month', $defaultMonth  , ['class' => 'month', 'name' => 'month']) }}
                    <select id="day" name="day">
                        @foreach($dateSelection as $date)
                            <option value="{{{ $date['day'] }}}"  {{ ($date['selected'])?'selected':'' }}  >{{{ NumberFormatter::addOrdinalNumberSuffix($date['day']) }}}</option>
                        @endforeach  
                    </select>
                    
                    <button id="search" class="btn">Search</button>    
            {{ Form::close() }}
            
        </div>
        
        <div class="table-responsive table-payment"> 
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Bank</th>
                        <th>Account Name</th>
                        <th>Account No.</th>
                        <th>Email</th>
                        <th>Contact No.</th>
                        <th>NET</th>
                    </tr>
                </thead>
                @foreach($accountsToPay as $account)
                    <tr>
                        <td>{{{ $account->username }}}</td>
                        <td>{{{ $account->bank_name }}} </td>
                        <td>{{{ $account->account_name }}} </td>
                        <td>{{{ $account->account_number }}} </td>
                        <td>{{{ $account->email }}}</td>
                        <td>{{{ $account->contactno }}}</td>
                        <td><strong>PHP {{  number_format($account->net, 2, '.', ',')  }}</strong></td>
                    </tr>
                @endforeach

            </table>
        </div>


  </div>
@stop