<?php

use Illuminate\Support\MessageBag;

class AccountController extends BaseController
{

	public function showLogin()
	{
		return View::make('pages.login');
	}
	
	public function doLogin()
	{
		$rules = array(
			'username' => 'required', // username
			'password' => 'required'                                     // password can only be alphanumeric and has to be greater than 3 characters
		);
		
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			Input::flash();
		    return View::make('pages.login')
				->withErrors($validator)
				->withInput(Input::except('password')); 
		}
		
		// create our user data for the authentication
		$userdata = array(
			'username' 	=> Input::get('username'),
			'password' 	=> Input::get('password'),
		);
		

		if (Auth::attempt($userdata)){
			return Redirect::to('/');  
		}
		
		$errors = new MessageBag(['login_error' => ['Username and/or password is invalid.']]); 
		Input::flash();
		return View::make('pages.login')
			->withErrors($errors)
			->withInput(Input::except('password')); 

		
		
	}
	
	public function doLogout()
	{
		Auth::logout();
		return Redirect::to('/');  
	}

	
}
