<?php

use Easyshop\Services\XMLContentGetterService as XMLService;
use Easyshop\ModelRepositories\CategoryRepository as CategoryRepository;
use Easyshop\ModelRepositories\AdminMemberRepository as AdminMemberRepository;

class MobileContentManagerController extends BaseController
{
    /**
     *  Constructor declaration for XMLService
     */
    protected $XMLService;

    /*
     * The Category Repository
     */    
    protected $categoryRepository;

    /*
     * The Administrator Repository
     */
    protected $adminRepository;

    public function __construct(XMLService $XMLService,
                                CategoryRepository $categoryRepository,
                                AdminMemberRepository $adminRepository)
    {
        $this->XMLService = $XMLService;
        $this->adminRepository = $adminRepository;
        $this->categoryRepository = $categoryRepository;
        $xmlString = $this->XMLService->getMobileHomeXml();
        $this->map = simplexml_load_string(trim($xmlString));
    }

    /**
     * Render Mobile CMS Interface
     * @return VIEW
     */
    public function showMobileCms()
    {

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

       $categoryLists = [];
       foreach ($this->categoryRepository->getParentCategories() as $value) {
            $categoryLists[] = [
                "slug" => $value->slug,
                "name" => $value->name
            ];
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

        foreach($this->map->mainSlide as $slides)
        {
            $mainSlides[] =  $slides;
        }     
        $actionTypes = [];
        foreach($this->map->actionLists as $actions)
        {
            $actionTypes[] =  $actions->type;
        }        
        return View::make('partials.mainslides')
            ->with('adminObject',$this->adminRepository->getAdminMemberById(Auth::id()))
            ->with('mainSlides',$mainSlides)
            ->with('mainSlideId',0)
            ->with('actionTypes',  $actionTypes[0])
            ->with('mainSlideCount',  count($mainSlides))
            ->with('homeCmsLink',$this->XMLService->getMobileCmsLink())
            ->with('easyShopLink',$this->XMLService->GetEasyShopLink());
    }    

    /**
     * Retrieves box contents
     * @param int $index
     * @return View
     */
    public function getBoxContent($index)
    {
        $section = [];
        $sectionContent = $this->map->section[(int)$index]->boxContent;
        foreach($sectionContent as $map) 
        {
             $section[] = $map;
        }
        return View::make('partials.boxcontent')        
                     ->with("index",$index)
                     ->with("boxContent",$section)
                     ->with("mobileCmsLink", $this->XMLService->getMobileCmsLink());
    }

}


