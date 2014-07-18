<?php

use Illuminate\Support\MessageBag;

class AccountController	extends HomeController{

	public function showLogin()
	{
		// show the form
		$this->layout =  View::make('layouts.noheader');
		$this->layout->title = "Login | Easyshop Admin";
		$this->layout->metadescription = "Login for Easyshop.ph Administrator Page";
		$this->layout->content = View::make('pages.login');
	}
	
	public function loginFormSubmit()
	{
		// process the form
		// validate the info, create rules for the inputs
		$rules = array(
			'username' => 'required', // make sure the email is an actual email
			'password' => 'required' // password can only be alphanumeric and has to be greater than 3 characters
		);
		
		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);
		
		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
		    return Redirect::to('login')
			->withErrors($validator) // send back all errors to the login form
			->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {
		    // create our user data for the authentication
		    $userdata = array(
			'username' 	=> Input::get('username'),
			'password' 	=> Input::get('password')
		    );
		    if (Auth::attempt($userdata)){
			return Redirect::to('/');  
		    }else{
			// validation not successful, send back to form	
			  $errors = new MessageBag(['login_error' => ['Username and/or password is invalid.']]); 
			  return Redirect::back()
			      ->withErrors($errors)
			      ->withInput(Input::except('password')); 
		    }

		}  
	}
	
	public function logout(){
		Auth::logout();
		return Redirect::to('/');  
	}

	
}
