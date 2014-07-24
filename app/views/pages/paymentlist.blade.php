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
        <p>Invoice Number: {{{ $order->invoice_no }}}</p>

  </div>
@stop