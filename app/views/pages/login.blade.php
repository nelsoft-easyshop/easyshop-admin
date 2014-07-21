@extends('layouts.default')

@section('description', 'Login for Easyshop.ph Administrator Page')
@section('keywords', '')
@section('title', 'Login | Easyshop Admin')


@section('page_header')
	<!-- no page header -->
@stop



@section('content')

	<div class = "login_container">
	    <div>
		<img src= "{{{ asset('images/easyshoplogo-transp.png') }}}" alt="easyshop">
	    </div>
	    
	    <div id="lbl_container">
		  
		    {{ Form::open(array('url' => 'login')) }}
			  <p>
				  {{ Form::text('username', Input::old('username'), array('placeholder' => 'Username')) }}
				  <div class='login_error_msg'>{{ $errors->first('username') }}</div>
			  </p>

			  <p>
				  {{ Form::password('password', array('placeholder' => 'Password')) }}
				  <div class='login_error_msg'>{{ $errors->first('password') }}</div>
			  </p>
			  
			  <p>
				  <div class='login_error_msg'>{{ $errors->first('login_error') }}</div>
			  </p>
			  <br/>
			  <p>{{ Form::submit('Submit', array('id' => 'btn_login')) }}</p>
		  {{ Form::close() }}

	    </div>
	    
	
	</div>

@stop
