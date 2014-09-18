<?php namespace Easyshop\Services;


use Easyshop\Services\XMLContentGetterService as XMLService;

class MessagesService 
{

    /**
     *  Constructor declaration for MessagesService and MessagesRepostory 
     */    
    protected $XMLService;

    public function __construct(XMLService $XMLService) 
    {   
        $this->XMLService = $XMLService;
    }
    /**
     *  Gets partner ids from the content_files.xml inside application/resources/pages in easyshop.ph
     */
    public function getPartnersId()
    {
        $map = simplexml_load_string(trim($this->XMLService->GetXmlContentFiles()));
        $target = current($map->xpath("/map/select[@id='partners-member-id']")); 
        return array_map('trim', explode(",",$target));
    }

}

