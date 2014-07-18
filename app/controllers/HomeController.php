<?php

class HomeController extends BaseController {

	public $layout = 'layouts.default';
	
	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
	    $this->layout =  View::make('layouts.noheader');
	    $this->layout->title = "Dashboard | Easyshop Admin";
	    $this->layout->metadescription = "Administrator Dashboard";
	    $this->layout->content = View::make('pages.dashboard')
	      ->with('username', Auth::user()->username);
	}
	
	
	public function getAllUsers(){
		$this->layout->headerTitle = 'Registered Users';
	      	$this->layout->title = "Registered Users| Easyshop Admin";
		$this->layout->content = View::make('pages.userlist');
	}

	

}
