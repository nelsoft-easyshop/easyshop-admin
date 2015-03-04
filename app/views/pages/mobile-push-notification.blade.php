@extends('layouts.default')

@section('description', 'Mobile Push Notification')
@section('keywords', '')
@section('title', 'Mobile Push Notification | Easyshop Admin')
@section('header_tagline', 'Mobile Push Notification')

@section('page_header')
    @include('includes.header')
    <link type="text/css" href="{{{ asset('css/style.css')  }}}" rel="stylesheet"  media="screen"/>
@stop

@section('content')
    <div id="mainsection">
        {{ Form::open(array('url' => "#", 'id'=>'pushForm','method'=>'post')) }}
            <div>
                <textarea placeholder="Notification Message Here..."></textarea>
            </div>
            <div>
                <button type="button">
                    Send to all IOS user
                </button>
                <button type="button">
                    Send to all Android user
                </button>
            </div>
        {{ Form::close() }}
    </div>
@stop

@section('page_js') 
    {{ HTML::script('js/productcsv.js') }}
@stop
