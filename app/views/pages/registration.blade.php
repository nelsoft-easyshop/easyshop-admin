@extends('layouts.default')

@section('description', 'Registration for Easyshop.ph Administrator Page')
@section('keywords', '')
@section('title', 'Registration | Easyshop Admin')



@section('content')

    <div class='row' >
    <div class = "registration_container">
            <div>
            <img src= "{{{ asset('images/easyshoplogo-transp.png') }}}" class='img-responsive'  alt="easyshop">
            </div>

            <div id="registration_form">
                {{ Form::open(array('url' => 'register','class'=>'form-horizontal')) }}
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
                            <button type="submit" id="btn_register" class="btn btn-primary">Register</button>
                        </div>
                    </div>

                    @if(isset($success))
                        <h1>Success!</h1>
                    @endif
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
