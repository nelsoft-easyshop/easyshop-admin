<?php namespace Easyshop\Composers;

use Illuminate\Support\Facades\Auth;

class HeaderComposer {
 
    public function compose($view)
    {
      $view->with('username',  Auth::user()->username);      
    }

}