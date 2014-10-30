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
                        <th>Buyer Name <span class="glyphicon glyphicon-chevron-up"  style="cursor:pointer;" data-sortby='es_member.username' data-sortorder='asc'></span></th>
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
            {{ $orders->links() }}

        </div>



      </div>
    
    
    
@stop


@section('page_js') 

  {{ HTML::script('js/src/jquery.datetimepicker.js') }}
  {{ HTML::script('js/payoutsbuyer.js') }}

@stop

