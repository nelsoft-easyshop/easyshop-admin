@extends('layouts.default')

@section('description', 'Mobile Push Notification')
@section('keywords', '')
@section('title', 'Mobile Push Notification | Easyshop Admin')
@section('header_tagline', 'Mobile Push Notification')

@section('page_header')
    @include('includes.header')
    <link type="text/css" href="{{{ asset('css/src/ladda/ladda-themeless.min.css')  }}}" rel="stylesheet"  media="screen"/>
    <link type="text/css" href="{{{ asset('css/style.css')  }}}" rel="stylesheet"  media="screen"/>
@stop

@section('content')
    <div id="mainsection">
        <div class="registration_form">
            <legend>Mobile Push Notification</legend>
            {{ Form::open(array('url' => "#", 'id'=>'pushForm','method'=>'post')) }}
                <div>
                    <textarea id="message-txt" class="form-control" rows="3" placeholder="Notification Message Here..."></textarea>
                </div>
                <br />
                <center>
                    <div class="center-block" >
                        <button type="button" data-type="{{{ $iosType }}}" class="notif-button btn btn-default">
                            Send to all IOS user
                        </button>
                        <button type="button" data-type="{{{ $androidType }}}" class="notif-button btn btn-default">
                            Send to all Android user
                        </button>
                    </div>
                </center>
            {{ Form::close() }}
        </div>
    </div>
@stop

@section('page_js') 
    {{ HTML::script('js/push_notification.js') }}
    {{ HTML::script('js/src/ladda/spin.js') }}
    {{ HTML::script('js/src/ladda/ladda.js') }}
@stop
