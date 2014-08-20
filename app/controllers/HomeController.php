<?php
class HomeController extends BaseController
{

    /**
     * Render admin dashboard page
     *
     */
    public function index()
    {
        return View::make('pages.dashboard')
            ->with('username', Auth::user()->username);
    }
}
