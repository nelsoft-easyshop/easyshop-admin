@extends('layouts.default')

@section('description', 'Payouts - Buyer')
@section('keywords', '')
@section('title', 'Payouts - Buyer | Easyshop Admin')
@section('header_tagline', 'Payouts - Buyer.')


@section('page_header')
    @include('includes.header')
@stop


@section('content')
<input type="hidden" id="filterSort" name="filter" class="form-control" value="{{$filter}}" />
<input type="hidden" id="filterBySort" name="filter" class="form-control" value="{{$filterBy}}" />
  <div id="mainsection">
        <br/>   
            {{ Form::open(array('url' => 'payout-buyer', 'id' => 'searchForm')) }}
            <div class="input-group srch_div" style="padding:12px">
                <div class="inner-addon left-addon">
                    <i class="glyphicon glyphicon-search"></i>
                    <input type="hidden" id="filterBy" name="filter" class="form-control" placeholder="Search transaction" />
                    <input type="text" id="searchBoxWord" name="filterBy" class="form-control" placeholder="Search transaction" />
                </div>
                <div class="input-group-btn">
                    &nbsp;
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Filters
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu dd-right" role="menu">
                        <li role="presentation" class="dropdown-header">Search by :</li>
                        <li><a class="drct_search" data="username" href="javascript:void(0)">Username</a></li>
                        <li><a class="drct_search" data="contactno" href="javascript:void(0)">Contact Number</a></li>
                        <li><a class="drct_search" data="email" href="javascript:void(0)">Email</a></li>
                        <li><a class="drct_search" data="id_order" href="javascript:void(0)">Order ID</a></li>
                        <li class="divider"></li>
                        <li role="presentation" class="dropdown-header">Click to View by Tag:</li>
                        <li><a class="drct_search" data="CONTACTED" data-value="1" href="javascript:void(0)">Contacted</a></li>
                        <li><a class="drct_search" data="ON-HOLD" data-value="3" href="javascript:void(0)">On-hold</a></li>
                        <li><a class="drct_search" data="REFUND" data-value="3" href="javascript:void(0)">Refund</a></li>
                    </ul>
                </div>
            </div>
            {{ Form::close() }}
        <div class="table-responsive table-payment transaction-list"> 
            <br/>
            <table id="table1" class="table table-striped table-hover">

                <thead>
                     <tr>
                        <th  style="cursor:pointer;">Order ID <span class="glyphicon glyphicon-chevron-up" data-sortby='es_order.id_order' data-sortorder='asc'></span>
                          {{ Form::open(array('url' => 'payout-buyer-sort', 'id' => 'orderForm', 'method' => 'get')) }}
                            <input type='hidden' name='page' id="pageNumber" value="1">
                            <input type='hidden' name="sortBy" id="sortBy" value=""/>
                            <input type='hidden' name="sortOrder" id="sortOrder" value=""/>
                          {{ Form::close() }}
                        </th>
                        <th>Username <span class="glyphicon glyphicon-chevron-up"  style="cursor:pointer;" data-sortby='es_member.username' data-sortorder='asc'></span></th>
                        <th>Email <span class="glyphicon glyphicon-chevron-up"  style="cursor:pointer;" data-sortby='es_member.email' data-sortorder='asc'></span></th>
                        <th>Status <span class="glyphicon glyphicon-chevron-up"  style="cursor:pointer;" data-sortby='es_tag_type.tag_description' data-sortorder='asc'></span></th>
                        <th>Contact Number<span class="glyphicon glyphicon-chevron-up"  style="cursor:pointer;" data-sortby='es_member.contactno' data-sortorder='asc'></span></th>
                     </tr>
                </thead>
                <tbody id="tbody">
                  @foreach($orders as $details)
                      <tr class='buyer-list'>
                          <td class='td_order_id'>{{{$details->id_order}}}</td>
                          <td class='username' data-memberid="{{{ $details->seller_id }}}">{{{$details->username}}}</td>
                          <td class='email'>{{{$details->email}}}</td>
                          <td class='email'><span class="org_btn view" style="background-color:{{  $details->tag_color  }};">{{{ ($details->tag_description) ? $details->tag_description : 'NO TAG'  }}} </span></td>
                          <td class="contactno">{{{ ($details->contactno) ? $details->contactno : 'N/A' }}}</td>                        
                      </tr>
                  @endforeach
                </tbody>
            </table>
            {{ $pagination }}

        </div>



      </div>
    
    
    
@stop


@section('page_js') 

  {{ HTML::script('js/src/jquery.datetimepicker.js') }}
  {{ HTML::script('js/payoutsbuyer.js') }}

@stop

