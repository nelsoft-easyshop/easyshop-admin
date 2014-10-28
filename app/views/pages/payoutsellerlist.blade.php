@extends('layouts.default')

@section('description', 'Seller Payout')
@section('keywords', '')
@section('title', 'Seller Payout | Easyshop Admin')
@section('header_tagline', 'Seller Pay-out.')


@section('page_header')
    @include('includes.header')
    <link type="text/css" href="{{{ asset('css/src/ladda/ladda-themeless.min.css')  }}}" rel="stylesheet"  media="screen"/>
@stop



@section('content')
    <div id="mainsection">
        <div class="table-responsive table-payment"> 
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Username</th>
                        <th>Number of Products</th> 
                        <th>Email</th>
                        <th>Contact No.</th>
                    </tr>
                </thead> 
                @foreach($transactionRecord as $record)
                    <tr class="seller_detail">
                        <td class="td_order_id">{{{ $record->id_order }}}</td>
                        <td class="td_username">{{{ $record->username }}}</td>
                        <td class="td_total">{{{ $record->count }}}</td>
                        <td class="td_email">{{{ $record->email }}}</td>
                        <td class="td_contact">{{{ ($record->contactno) ? $record->contactno : 'N/A' }}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@stop

@section('page_js')  
  {{ HTML::script('js/payoutseller.js') }}
  {{ HTML::script('js/src/ladda/spin.js') }}
  {{ HTML::script('js/src/ladda/ladda.js') }}
@stop

