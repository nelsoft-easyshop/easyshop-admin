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
        $username = false;
        if(Auth::user()){
            $username = Auth::user()->username;
        }
            
        $view->with('username',  $username);   
    }

}

