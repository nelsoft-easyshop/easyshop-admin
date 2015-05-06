<?php

/**
 * Make sure this is set in the Laravel env file
 */
$baseUrl = isset($_ENV['webservice_base_url']) ? 
           $_ENV['webservice_base_url'] : "https://easyshop.ph.local";

return [
    /*
    |--------------------------------------------------------------------------
    | Webservice Link
    |--------------------------------------------------------------------------
    |
    | Returns the main webservice routes
    | 
    */
    'easyShopLink'=> "$baseUrl",
    'homeCmsLink' => "$baseUrl/webservice/newhomewebservice",
    'getHomeXml'=> "$baseUrl/webservice/newhomewebservice/getcontents",
    'feedCmsLink' => "$baseUrl/webservice/feedwebservice",
    'mobileCmsLink' => "$baseUrl/webservice/mobilewebservice",
    'getFeedXML'=> "$baseUrl/webservice/feedwebservice/getcontents/",
    'productCSVwebservice'=> "$baseUrl/webservice/synccsvimage",
    'getMobileXml'=> "$baseUrl/webservice/mobilewebservice/getcontents",
    'getTempHomeXml'=> "$baseUrl/webservice/newhomewebservice/getTempContents",
    'syncXmlFileLink'=> "$baseUrl/webservice/newhomewebservice/syncTempHomeFiles",
    'assetsLink'=> "$baseUrl/webservice/newhomewebservice/getAssetsLink",
];
