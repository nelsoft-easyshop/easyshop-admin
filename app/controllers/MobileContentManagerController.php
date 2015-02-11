<?php

use Easyshop\Services\XMLContentGetterService as XMLService;

class MobileContentManagerController extends BaseController
{
    /**
     *  Constructor declaration for XMLService  
     */
    protected $XMLService;

    public function __construct(XMLService $XMLService) 
    {   
        $this->XMLService = $XMLService;
        $xmlString = $this->XMLService->getMobileHomeXml();
        $this->map = simplexml_load_string(trim($xmlString));


    }

    /**
     * Render Mobile CMS Interface
     * @return VIEW
     */
    public function showMobileCms()
    {

        $adminEntity = App::make('AdminMemberRepository');        
        $section = [];
        foreach($this->map->section as $map) 
        {
            $section[] = $map;
        }

        $mainSlides = [];
        foreach($this->map->mainSlide as $slides)
        {
            $mainSlides[] =  $slides;
        }

        $actionTypes = [];
        foreach($this->map->actionLists as $actions)
        {
            $actionTypes[] =  $actions->type;
        }
       
        return View::make('pages.cms-mobilehome')
                    ->with('adminObject', $adminEntity->getAdminMemberById(Auth::id()))
                    ->with('sectionContent', $section)
                    ->with('mainSlides',  $mainSlides)
                    ->with('actionTypes',  $actionTypes[0])
                    ->with('mainSlideId',  0)
                    ->with('mainSlideCount',  count($mainSlides))                    
                    ->with('mobileCmsLink', $this->XMLService->getMobileCmsLink())
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());                    
    }

    /**
     * Reload mainSlides panel
     * @return VIEW
     */
    public function getMainSlides() 
    {

        $adminEntity = App::make('AdminMemberRepository');
        foreach($this->map->mainSlide as $slides)
        {
            $mainSlides[] =  $slides;
        }     
        return View::make('partials.mainslides')
            ->with('adminObject',$adminEntity->getAdminMemberById(Auth::id()))
            ->with('mainSlides',$mainSlides)
            ->with('mainSlideId',0)
            ->with('mainSlideCount',  count($mainSlides))
            ->with('homeCmsLink',$this->XMLService->getMobileCmsLink())
            ->with('easyShopLink',$this->XMLService->GetEasyShopLink());
    }    


}


