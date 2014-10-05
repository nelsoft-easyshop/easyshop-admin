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

        foreach($this->map->section as $map) {
            $section[] = $map;
        }
        foreach($this->map->mainSlide as $slides)
        {
            $mainSlides[] =  $slides;
        }        
        return View::make('pages.cms-mobilehome')
                    ->with('userid', Auth::id())
                    ->with('password', $adminEntity->getAdminMemberById(Auth::id()))
                    ->with('sectionContent', $section)
                    ->with('mainSlides',  $mainSlides)
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
            ->with('adminPassword', $adminEntity->getAdminMemberById(Auth::id()))
            ->with('userId', Auth::id())
            ->with('mainSlides',$mainSlides)
            ->with('mainSlideId',0)
            ->with('mainSlideCount',  count($mainSlides))
            ->with('homeCmsLink',$this->XMLService->getMobileCmsLink())
            ->with('easyShopLink',$this->XMLService->GetEasyShopLink());
    }    


}


