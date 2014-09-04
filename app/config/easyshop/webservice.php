<?php

$baseUrl = isset($_ENV['webservice_base_url']) ? $_ENV['webservice_base_url'] :  "https://easyshop.ph.local";
return array(

    /*
    |--------------------------------------------------------------------------
    | Webservice Link
    |--------------------------------------------------------------------------
    |
    | Returns the link of the homewebservice controller found in https://easyshop.ph.feature/webservice/homewebservice
    | 
    | 
    |
    */
    'homeCmsLink' => "$baseUrl/webservice/homewebservice",
    'feedCmsLink' => "$baseUrl/webservice/feedwebservice",
    'getHomeXML'=> "$baseUrl/webservice/homewebservice/getContents/",
    'getFeedXML'=> "$baseUrl/webservice/feedwebservice/getcontents/",
    'easyShopLink'=> "$baseUrl",
);



