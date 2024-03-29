@extends('layouts.default')

@section('description', 'Contact Seller')
@section('keywords', '')
@section('title', 'Contact Seller | Easyshop Admin')
@section('header_tagline', 'Contact Seller')


@section('page_header')
    @include('includes.header')
    <link type="text/css" href="{{{ asset('css/src/ladda/ladda-themeless.min.css')  }}}" rel="stylesheet"  media="screen"/>
@stop



@section('content')
 
        <div id="mainsection">
            {{ Form::open(array('url' => 'contact/seller', 'id' => 'searchForm')) }}
            <div class="input-group srch_div" style="padding:12px">
                <div class="inner-addon left-addon">
                    <i class="glyphicon glyphicon-search"></i>
                    <input type="text" id="searchBox"  class="form-control" placeholder="Search transaction" />
                </div>
                <div class="input-group-btn">
                    &nbsp;
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Filters
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu dd-right" role="menu">
                        <li role="presentation" class="dropdown-header">Search by :</li>
                        <li><a class="drct_search" data="src_fullname" href="javascript:void(0)">Fullname</a></li>
                        <li><a class="drct_search" data="src_storename" href="javascript:void(0)">Store Name</a></li>
                        <li><a class="drct_search" data="src_number" href="javascript:void(0)">Contact Number</a></li>
                        <li><a class="drct_search" data="src_email" href="javascript:void(0)">Email</a></li>
                        <li><a class="drct_search" data="src_invoiceno" href="javascript:void(0)">Invoice No</a></li>
                        <li><a class="drct_search" data="src_transactionid" href="javascript:void(0)">Transaction ID</a></li>
                        <li class="divider"></li>
                        <li><a class="tag_default" href="javascript:void(0)">Default</a></li>
                        <li><a class="tag_search" data="src_tag" data-value="1" href="javascript:void(0)">Contacted</a></li>
                        <li><a class="tag_search" data="src_tag" data-value="3" href="javascript:void(0)">On-hold</a></li>
                        <li><a class="tag_search" data="src_tag" data-value="5" href="javascript:void(0)">Confirmed</a></li>
                        <li><a class="tag_search" data="src_tag" data-value="2" href="javascript:void(0)">Refund</a></li>
                    </ul>
                </div>
                <input type="hidden" id="src_fullname" name="fullname" />
                <input type="hidden" id="src_storename" name="store_name" />
                <input type="hidden" id="src_number" name="number" />
                <input type="hidden" id="src_email" name="email" />
                <input type="hidden" id="src_invoiceno" name="invoiceno" />
                <input type="hidden" id="src_transactionid" name="transactionid" />
                <input type="hidden" id="src_tag" name="tag" />
            </div>
            {{ Form::close() }}
            <div class="clear"></div>
            <div class="table-responsive table-payment"> 
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Transaction ID</th>
                            <th>Invoice Number</th>
                            <th>Seller Fullname</th>
                            <th>Seller Store Name</th>
                            <th>Number of Products</th> 
                            <th>Seller Email</th>
                            <th>Seller Contact No.</th>
                            <th>Transaction Date</th>
                            @if($tagType)
                            <th>Current Tag</th>
                            @endif
                        </tr>
                    </thead> 
                    @foreach($transactionRecord as $record)
                        <tr class="seller_detail">
                            <td class="td_order_id">{{{ $record->id_order }}}</td>
                            <td class="td_transaction_id">{{{ $record->transaction_id }}}</td>
                            <td class="td_invoice_no">{{{ $record->invoice_no }}}</td>
                            <td class="td_fullname" >{{{ $record->fullname }}}</td>
                            <td class="td_username" data-member-id="{{{ $record->id_member }}}" >{{{ $record->store_name }}}</td>
                            <td class="td_total">{{{ $record->count }}}</td>
                            <td class="td_email">{{{ $record->email }}}</td>
                            <td class="td_contact">{{{ ($record->contactno) ? $record->contactno : 'N/A' }}}</td>
                            <td clas="transaction_date">{{{ $record->dateadded }}}</td>
                            @if($tagType)
                            <td class="td_status">
                                <span class="count-tag">{{{ $record->tag_count }}}</span> / 
                                <span class="total-tagged">{{{ $record->count }}}</span>
                            </td>
                            @endif
                        </tr>
                        
                    @endforeach
                </table>
            </div>
            {{ $pagination }}
        </div>

        <div id="hidden-values">
            <input type="hidden" id="confirmed-constant" value="{{{ $constantValues['confirmed'] }}}" />
            <input type="hidden" id="refund-constant" value="{{{ $constantValues['refund'] }}}" />
            <input type="hidden" id="contacted-constant" value="{{{ $constantValues['contacted'] }}}" />
            <input id="defaultStatus" type="hidden" value="{{{ $defaultStatus }}}" >
            <input id="nonDefaultStatus" type="hidden" value="{{{ $nonDefaultStatus }}}" >
            <input id="currentTag" type="hidden" value="{{{ $tagType }}}" >
        </div>
@stop

@section('page_js')  
  {{ HTML::script('js/payoutseller.js') }}
  {{ HTML::script('js/src/ladda/spin.js') }}
  {{ HTML::script('js/src/ladda/ladda.js') }}
  {{ HTML::script('js/src/jquery.datetimepicker.js') }} 
@stop

