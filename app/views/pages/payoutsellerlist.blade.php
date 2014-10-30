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
            {{ Form::open(array('url' => 'payout/seller', 'id' => 'searchForm')) }}
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
                        <li><a class="drct_search" data="src_username" href="javascript:void(0)">Username</a></li>
                        <li><a class="drct_search" data="src_number" href="javascript:void(0)">Contact Number</a></li>
                        <li><a class="drct_search" data="src_email" href="javascript:void(0)">Email</a></li>
                        <li class="divider"></li>
                        <li><a class="tag_search" data="src_email" data-value="1" href="javascript:void(0)">Contacted</a></li>
                        <li><a class="tag_search" data="src_tag" data-value="3" href="javascript:void(0)">On-hold</a></li>
                    </ul>
                </div>
                <input type="hidden" id="src_fullname" name="fullname" />
                <input type="hidden" id="src_username" name="username" />
                <input type="hidden" id="src_number" name="number" />
                <input type="hidden" id="src_email" name="email" />
                <input type="hidden" id="src_tag" name="tag" />
            </div>
            {{ Form::close() }}
            <div class="clear"></div>
            <div class="table-responsive table-payment"> 
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Fullname</th>
                            <th>Username</th>
                            <th>Number of Products</th> 
                            <th>Email</th>
                            <th>Contact No.</th>
                            <th>Current Tag</th>
                        </tr>
                    </thead> 
                    @foreach($transactionRecord as $record)
                        <tr class="seller_detail">
                            <td class="td_order_id">{{{ $record->id_order }}}</td>
                            <td class="td_fullname" >{{{ $record->fullname }}}</td>
                            <td class="td_username" data-member-id="{{{ $record->id_member }}}" >{{{ $record->username }}}</td>
                            <td class="td_total">{{{ $record->count }}}</td>
                            <td class="td_email">{{{ $record->email }}}</td>
                            <td class="td_contact">{{{ ($record->contactno) ? $record->contactno : 'N/A' }}}</td>
                            <td class="td_status">
                                <span class="org_btn view" style="background-color:{{{ $record->tag_color }}}" >{{{ ($record->tag_type_id) ? $record->tag_description : 'No Tag' }}}</span>
                            </td>
                        </tr>
                        
                    @endforeach
                </table>
            </div>
            {{ $pagination }}
        </div> 
@stop

@section('page_js')  
  {{ HTML::script('js/payoutseller.js') }}
  {{ HTML::script('js/src/ladda/spin.js') }}
  {{ HTML::script('js/src/ladda/ladda.js') }}
@stop

