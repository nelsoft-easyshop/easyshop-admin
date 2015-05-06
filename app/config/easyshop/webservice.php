<?php

$baseUrl = isset($_ENV['webservice_base_url']) ? $_ENV['webservice_base_url'] :  "https://easyshop.ph.local";
return array(

    /*
    |--------------------------------------------------------------------------
    | Webservice Link
    |--------------------------------------------------------------------------
    |
    | Returns the main webservice routes
    | 
    */
    'newHomeCmsLink' => "$baseUrl/webservice/newhomewebservice",
    'feedCmsLink' => "$baseUrl/webservice/feedwebservice",
    'mobileCmsLink' => "$baseUrl/webservice/mobilewebservice",
    'getHomeXML'=> "$baseUrl/webservice/homewebservice/getContents/",
    'getFeedXML'=> "$baseUrl/webservice/feedwebservice/getcontents/",
    'productCSVwebservice'=> "$baseUrl/webservice/synccsvimage",
    'easyShopLink'=> "$baseUrl",
    'getMobileXml'=> "$baseUrl/webservice/mobilewebservice/getcontents",
    'getNewHomeXml'=> "$baseUrl/webservice/newhomewebservice/getcontents",
    'getTempHomeXml'=> "$baseUrl/webservice/newhomewebservice/getTempContents",
    'syncXmlFileLink'=> "$baseUrl/webservice/newhomewebservice/syncTempHomeFiles",
    'assetsLink'=> "$baseUrl/webservice/newhomewebservice/getAssetsLink",
);



