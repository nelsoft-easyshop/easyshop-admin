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
        return file_get_contents(\Config::get('easyshop/webservice.getHomeXML'));
    }

    /**
     * Returns the link https://easyshop.ph.local/webservice/homewebservice
     *
     * @return $link
     */
    public function GetHomeCmsLink()
    {
        return \Config::get('easyshop/webservice.homeCmsLink');
    }


    /**
     * Returns the link https://easyshop.ph.local/webservice/contentwebservice
     *
     * @return $link
     */
    public function GetContentCmsLink()
    {
        return \Config::get('easyshop/webservice.feedCmsLink');
    }

    /**
     * Returns the link https://easyshop.ph.local/webservice/mobilewebservice
     *
     * @return $link
     */
    public function getMobileCmsLink()
    {
        return \Config::get('easyshop/webservice.mobileCmsLink');
    }    


    /**
     * Returns the link https://easyshop.ph.local/webservice/mobilewebservice
     *
     * @return $link
     */
    public function getNewHomeCmsLink()
    {
        return \Config::get('easyshop/webservice.newHomeCmsLink');
    }       

    /**
     *  Returns the the link https://www.easyshop.ph
     *
     *  @return string $link
     */
    public function GetEasyShopLink()
    {
        return \Config::get('easyshop/webservice.easyShopLink');

    }

    /**
     *  Returns the the link https://easyshop.ph.local/webservice/contentwebservice/getContents/
     *
     *  @return string $link
     */
    public function GetXmlContentFiles()
    {
        return file_get_contents(\Config::get('easyshop/webservice.getFeedXML'));
    }

    /**
     *  Returns the the link https://easyshop.ph.local/webservice/contentwebservice/getContents/
     *
     *  @return string $link
     */
    public function getMobileHomeXml()
    {

        return file_get_contents(\Config::get('easyshop/webservice.getMobileXml'));
    }    

    /**
     *  Returns the the link https://easyshop.ph.local/webservice/newhomewebservice/getContents/
     *
     *  @return string $link
     */
    public function getNewHomeXml()
    {
        return file_get_contents(\Config::get('easyshop/webservice.getNewHomeXml'));
    }   

    /**
     *  Returns the contents new_home_page_temp.xml
     *
     *  @return string $link
     */
    public function getTempHomeXml()
    {
        return file_get_contents(\Config::get('easyshop/webservice.getTempHomeXml'));
    }    

    /**
     *  Returns result of synxTempHomeFiles()
     *
     *  @return json
     */
    public function syncXMLFiles()
    {
        return file_get_contents(\Config::get('easyshop/webservice.syncXmlFileLink'));
    }   

    /**
     * Returns assets link
     * @return json
     */
    public function getAssetsLink()       
    {
        return file_get_contents(\Config::get('easyshop/webservice.assetsLink'));

    }
}
