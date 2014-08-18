<?php namespace Easyshop\Services;

class XMLContentGetterService
{
    /**
     * Returns xml content from of home_files.xml from easyshop.ph
     * 
     * @return $xmlString
     */
    public function GetXmlContent()
    {
        $xmlString = file_get_contents("https://easyshop.ph.feature/webservice/homewebservice/getContents/");
        return $xmlString;
    }

}
