<?php namespace Easyshop\Composers;

use Illuminate\Support\Facades\Auth;



class HeaderComposer 
{
	
	/**
	*    Inject parameters in $view everytime the view is loaded
	*
	*    @param View $view
	*/
	
    public function compose($view)
    {
		$view->with('username',  Auth::user()->username);   
    }

}