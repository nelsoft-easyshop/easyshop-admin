<?php

use Easyshop\Services\XMLContentGetterService as XMLService;



class NewHomeContentManagerController extends BaseController 
{

    public function getHomeContent()
    {
        return View::make('pages.cms-newhome'); 
    }
}
