<?php
class HomeController extends BaseController
{
    public function index()
    {
        return View::make('pages.dashboard')->with('username', Auth::user()->username);
    }

}
