@extends('layouts.default')

@section('description', 'Login for Easyshop.ph Administrator Page')
@section('keywords', '')
@section('title', 'Login | Easyshop Admin')



@section('content')

    <div class = "login_container">
        <div>
        <img src= "{{{ asset('images/easyshoplogo-transp.png') }}}" alt="easyshop">
        </div>
        
        <div id="lbl_container">
            
            {{ Form::open(array('url' => 'login')) }}
                <p>
                    <div class="form-group">
                        {{ Form::text('username', Input::old('username'), array('class'=>'form-control', 'placeholder' => 'Username')) }}
                        <div class='help-block'>{{ $errors->first('username') }}</div>
                    </div>
                </p>

                <p>
                     <div class="form-group">
                    {{ Form::password('password', array('class'=>'form-control','placeholder' => 'Password')) }}
                    <div class='help-block'>{{ $errors->first('password') }}</div>
                    <div class='help-block'>{{ $errors->first('login_error') }}</div>
                    </div>
                </p>

                <br/>
                <p>{{ Form::submit('Submit', array('class' => 'btn', 'id' => 'btn_login')) }}</p>
                
            {{ Form::close() }}

        </div>
        

    </div>

@stop
