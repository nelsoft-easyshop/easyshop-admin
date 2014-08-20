@extends('layouts.default')

@section('description', 'Transactions List')
@section('keywords', '')
@section('title', 'Transactions List | Easyshop Admin')
@section('header_tagline', 'Transactions List.')


@section('page_header')
    @include('includes.header')
@stop


@section('content')
  <div id="mainsection">
        <br/>

        <div class="table-responsive table-payment"> 
            <table class="table table-striped table-hover">
                <thead>
                     <tr>
                        <th>Order ID</th>
                        <th>Invoice No</th>
                        <th>Transaction ID</th>
                        <th>Total Amount</th>
                        <th>Buyer</th>
                        <th>Seller</th>
                        <th>Product Name</th>
                        <th>Status</th>
                        <th>Date of Transaction</th>
                     </tr>
                </thead>
            </table>
        </div>
  </div>
    
@stop


