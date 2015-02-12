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
       
        $themeLists = [];
        foreach($this->map->themeLists as $themes)
        {
            $themeLists[] =  $themes->value;
        }        

        return View::make('pages.cms-mobilehome')
                    ->with('adminObject', $this->adminRepository->getAdminMemberById(Auth::id()))
                    ->with('sectionContent', $section)
                    ->with('categoryLists', $categoryLists)
                    ->with('mainSlides',  $mainSlides)
                    ->with('actionTypes',  $actionTypes[0])
                    ->with('mainSlideId',  0)
                    ->with('mainSlideCount',  count($mainSlides))                    
                    ->with('mobileCmsLink', $this->XMLService->getMobileCmsLink())
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink())               
                    ->with('themeLists',$themeLists[0]);                         
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
            ->with('adminPassword', $adminEntity->getAdminMemberById(Auth::id()))
            ->with('userId', Auth::id())
            ->with('mainSlides',$mainSlides)
            ->with('mainSlideId',0)
            ->with('mainSlideCount',  count($mainSlides))
            ->with('homeCmsLink',$this->XMLService->getMobileCmsLink())
            ->with('easyShopLink',$this->XMLService->GetEasyShopLink());
    }    


}


