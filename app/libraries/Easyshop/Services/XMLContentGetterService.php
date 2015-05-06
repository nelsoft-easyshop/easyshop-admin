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
     * Returns the link home web service link
     *
     * @return $link
     */
    public function GetHomeCmsLink()
    {
        return \Config::get('easyshop/webservice.homeCmsLink');
    }


    /**
     * Returns the content CMS webservice link
     *
     * @return $link
     */
    public function GetContentCmsLink()
    {
        return \Config::get('easyshop/webservice.feedCmsLink');
    }

    /**
     * Returns the mobile CMS webservice link
     *
     * @return $link
     */
    public function getMobileCmsLink()
    {
        return \Config::get('easyshop/webservice.mobileCmsLink');
    }    


    /**
     * Returns the homepage CMS webservice link
     *
     * @return $link
     */
    public function getNewHomeCmsLink()
    {
        return \Config::get('easyshop/webservice.newHomeCmsLink');
    }       

    /**
     *  Returns the homepage of the easyshop back-end
     *
     *  @return string $link
     */
    public function GetEasyShopLink()
    {
        return \Config::get('easyshop/webservice.easyShopLink');

    }

    /**
     *  Returns the xml content of content_files.xml file
     *
     *  @return mixed 
     */
    public function GetXmlContentFiles()
    {
        return file_get_contents(\Config::get('easyshop/webservice.getFeedXML'));
    }

    /**
     *  Returns the xml content of mobile_home_files.xml file
     *
     *  @return mixed
     */
    public function getMobileHomeXml()
    {

        return file_get_contents(\Config::get('easyshop/webservice.getMobileXml'));
    }    

    /**
     *  Returns the xml content of the home page xml file 
     *
     *  @return mixed
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
     *  Returns result of xml homepage syncing webservice
     *
     *  @return mixed
     */
    public function syncXMLFiles($id, $password)
    {

        $syncXmlLink = \Config::get('easyshop/webservice.syncXmlFileLink');
        $syncXmlLink .= "?".http_build_query(array_merge($_GET, [
            "userid" => \Auth::id(), 
            "hash" => sha1(\Auth::id().$password)
        ]));
        return file_get_contents($syncXmlLink);
    }          

    /**
     * Returns assets link
     *
     * @return string
     */
    public function getAssetsLink()       
    {
        return file_get_contents(\Config::get('easyshop/webservice.assetsLink'));

    }
}
