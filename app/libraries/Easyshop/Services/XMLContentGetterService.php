<?php namespace Easyshop\Services;

class XMLContentGetterService
{
    /**
     * Returns xml content from of home_files.xml from easyshop.ph
     * 
     * @return $xmlString
     */
    public function GetXMLHomeFiles()
    {
        $xmlString = file_get_contents(\Config::get('easyshop/webservice.getHomeXML'));
        return $xmlString;
    }

    /**
     * Returns the link https://easyshop.ph.local/webservice/homewebservice
     *
     * @return $link
     */
    public function GetHomeCmsLink()
    {
        $link = \Config::get('easyshop/webservice.homeCmsLink');
        return $link;
    }


    /**
     * Returns the link https://easyshop.ph.local/webservice/contentwebservice
     *
     * @return $link
     */
    public function GetContentCmsLink()
    {
        $link = \Config::get('easyshop/webservice.feedCmsLink');
        return $link;
    }

    /**
     * Returns the link https://easyshop.ph.local/webservice/mobilewebservice
     *
     * @return $link
     */
    public function getMobileCmsLink()
    {
        $link = \Config::get('easyshop/webservice.mobileCmsLink');
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

    /**
     *  Returns the the link https://easyshop.ph.local/webservice/contentwebservice/getContents/
     *
     *  @return string $link
     */
    public function GetXmlContentFiles()
    {

        $xmlString = file_get_contents(\Config::get('easyshop/webservice.getFeedXML'));
        return $xmlString;
    }

    /**
     *  Returns the the link https://easyshop.ph.local/webservice/contentwebservice/getContents/
     *
     *  @return string $link
     */
    public function getMobileHomeXml()
    {

        $xmlString = file_get_contents(\Config::get('easyshop/webservice.getMobileXml'));
        return $xmlString;
    }    
}
