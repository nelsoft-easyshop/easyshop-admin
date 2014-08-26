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
        $xmlString = file_get_contents(\Config::get('easyshop/webservice.getXML'));
        return $xmlString;
    }

    public function GetHomeCmsLink()
    {
        $link = \Config::get('easyshop/webservice.homeCmsLink');
        return $link;
    }
    /**
     *  Returns the the link https://www.easyshop.ph
     *
     *  @return string $link
     */
    public function GetEasyShopLink()
    {
        $link = \Config::get('easyshop/webservice.easyShopLink');
        return $link;

    }
}
