@extends('layouts.default')

@section('description', 'Refund List')
@section('keywords', '')
@section('title', 'Refund List | Easyshop Admin')
@section('header_tagline', 'Buyers to Refund.')

@section('page_header')
    @include('includes.header')
    <link type="text/css" href="{{{ asset('css/src/ladda/ladda-themeless.min.css')  }}}" rel="stylesheet"  media="screen"/>
@stop


@section('content')
  <div id="mainsection">
        <div class="refund_search_filter_container">

            {{ Form::open(array('url' => 'refund', 'method' => 'get')) }}

                    {{ Form::text('username', '', array('id' => 'username', 'placeholder' => 'Username')) }}
         
                    <button id="search" class="btn">Search</button>    
            {{ Form::close() }}
            
        </div>
  </div>
@stop