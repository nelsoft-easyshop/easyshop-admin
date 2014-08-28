@extends('layouts.default')

@section('description', 'Register Administrator')
@section('keywords', '')
@section('title', 'Register Administrator | Easyshop Admin')
@section('header_tagline', 'Register Administrator')


@section('page_header')
    @include('includes.header')
    <link type="text/css" href="{{{ asset('css/src/ladda/ladda-themeless.min.css')  }}}" rel="stylesheet"  media="screen"/>
    <link type="text/css" href="{{{ asset('css/style.css')  }}}" rel="stylesheet"  media="screen"/>
@stop


@section('content')
    <div id="mainsection">
  
        <div class='registration_form' id="registration_form">
            {{ Form::open(array('url' => 'register','class'=>'form-horizontal','id'=>'form')) }}
                <legend>Register Administrator</legend>
                    <div class="form-group">
                        <label for="inputEmail" class="control-label col-xs-2">Username</label>
                        <div class="col-xs-10">
                            {{ Form::text('username', "", array('class' => 'form-control','id' => 'inputUsername','placeholder'=>'Username')) }}
                            <div class='help-block text-center'>{{ $errors->first('username') }}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="control-label col-xs-2">Password</label>
                        <div class="col-xs-10">
                            {{ Form::password('password', array('class'=>'form-control','placeholder' => 'Password','id'=>'inputPassword')) }}
                            <div class='help-block text-center'>{{ $errors->first('password') }}</div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="control-label col-xs-2">Fullname</label>
                        <div class="col-xs-10">
                            {{ Form::text('fullname', "", array('class' => 'form-control','id' => 'inputFullname','placeholder'=>'Fullname')) }}                        
                            <div class='help-block text-center'>{{ $errors->first('fullname') }}</div>
                        </div>
                    </div>                

                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-10">
                            <input type="submit" id="btn_register" class="btn btn-primary" value="Register Administartor">
                        </div>
                    </div>

                    @if(isset($success))

                    @endif
            {{ Form::close() }}
            <div class="modal fade" id="loading" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body" style='text-align:center;`'>
                            <img src="{{{ asset('images/orange_loader.gif') }}}">
                            <h3>Please Wait..</h3>        
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="success" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body" style='text-align:center;'>
                            <img src="{{{ asset('images/es_32x32.png') }}}">
                            <h3>Success</h3>        
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="error" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body"  style='text-align:center;'>
                            <img src="{{{ asset('images/img_alert.png') }}}">
                            <div id="changeTextError"></div>  
                        </div>
                    </div>
                </div>
            </div>            

        </div>
    </div>
  

    
  
@stop

@section('page_js') 
  {{ HTML::script('js/src/register.js') }}
  {{ HTML::script('js/src/ladda/spin.js') }}
  {{ HTML::script('js/src/ladda/ladda.js') }}
@stop

