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
    'mobileCmsLink' => "$baseUrl/webservice/mobilewebservice",
    'getHomeXML'=> "$baseUrl/webservice/homewebservice/getContents/",
    'getFeedXML'=> "$baseUrl/webservice/feedwebservice/getcontents/",
    'productCSVwebservice'=> "$baseUrl/webservice/synccsvImage",
    'easyShopLink'=> "$baseUrl",
    'getMobileXml'=> "$baseUrl/webservice/mobilewebservice/getcontents",
);



