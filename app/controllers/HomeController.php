<?php

class HomeController extends BaseController 
{

    /**
     * Render admin dashboard page
     *
     */
    public function index()
    {
        return View::make('pages.dashboard')->with('username', Auth::user()->username);
    }

    /**
     * Render page for generating user list
     *
     */
    public function getAllUsers(){
        return View::make('pages.userlist');
    }


}
