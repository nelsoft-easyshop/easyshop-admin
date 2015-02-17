<?php

use Easyshop\Services\XMLContentGetterService as XMLService;
use Easyshop\ModelRepositories\ProductRepository as ProductRepository;

class NewHomeContentManagerController extends BaseController 
{
    /**
     *  Constructor declaration for XMLService  
     */
    protected $XMLService;
    protected $productRepository;

    public function __construct(XMLService $XMLService,
                                ProductRepository $productRepository) 
    {   
        $this->XMLService = $XMLService;    
        $this->productRepository = $productRepository;    
    }      
      
    /**
     *  Organizes and retrieves contents from home_files.xml
     */      
    public function getHomeContent()
    {
        $adminRepo = App::make('AdminMemberRepository');   
        $adminObject = $adminRepo->getAdminMemberById(Auth::id()); 

        $this->XMLService->syncXMLFiles(Auth::id(), $adminObject->password);
        $xmlString = $this->XMLService->getNewHomeXml();
        $this->map = simplexml_load_string(trim($xmlString));

        $sliderXmlString = $this->XMLService->getTempHomeXml();
        $this->temporarySliderMap = simplexml_load_string(trim($sliderXmlString)); 

        $otherCategories = [];
        foreach($this->map->categoryNavigation->otherCategories as $map) {
            $otherCategories[] = $map;
        }        

        $categoryNavigation = [];
        foreach($this->map->categoryNavigation->category as $map) {
            $categoryNavigation[] = $map;
        }         

        $categoryRepository = App::make('CategoryRepository');          

        $categoryLists = [];
        foreach ($categoryRepository->getParentCategories() as $value) {
            $categoryLists[] = [
                "slug" => $value->slug, 
                "name" => $value->name
            ];
        }

        $childCategoryLists = [];
        foreach ($categoryRepository->getChildCategories() as $value) {
            $childCategoryLists[] = [
                "slug" => $value->slug, 
                "name" => $value->name
            ];
        }               

        $sliders = [];
        foreach($this->temporarySliderMap->sliderSection->slide as $slides) {
            $sliders[] = $slides;
        }
        
        $adsSection[] = [];        
        foreach($this->map->adSection as $ads) {
            $adsSection[] = $ads;
        }     
        
        $product = [];
        $productEntity = App::make('ProductRepository');
        foreach($this->map->sellerSection->productPanel as $productPanel)
        {
            $productObj = $productEntity->getProductBySlug($productPanel->slug);   
            if(count($productObj) > 0) {
                $product[] = $productObj;
            }            
        }

        $index = 0;
        $categoryProductPanel = [];
        $categoryProductPanelList = [];
        $categorySection = [];
        foreach($this->map->categorySection as $categoryPanel)
        {
            foreach($categoryPanel->sub as $productPanel)
            {
                foreach ($productPanel->productSlugs as $slug) {
                    $productObj = $productEntity->getProductBySlug($slug);
                    if(count($productObj) > 0) {
                        $categoryProductPanel[] = $productObj;
                    }                    
                }
                $categoryProductPanelList[] = array_flatten([
                    $index => $categoryProductPanel 
                ]);
                $index++;                
                $categoryProductPanel = [];
            }
            $categorySection[] = $categoryPanel;
        }

        $newArrivals = [];
        foreach($this->map->menu->newArrivals[0] as $arrivals)
        {
            $newArrivals[] = $arrivals;
        }

        $topProducts = [];
        foreach($this->map->menu->topProducts as $tProducts)
        {
            $topProducts[] = $tProducts;
        }   

        $topSellers = [];
        foreach($this->map->menu->topSellers as $tSellers)
        {
            $topSellers[] = $tSellers;
        }           
        $brandRepository = App::make("BrandRepository");

        $brandsLists = [];
        foreach($this->map->brandSection->brandId as $brands) 
        {
            $brandsLists[] = $brandRepository->getBrandById($brands);                  

        } 

        return View::make('pages.cms-newhome')
                    ->with('userid', Auth::id())
                    ->with('allBrandsLists', $brandRepository->getAllBrands())
                    ->with('brandsLists', $brandsLists)
                    ->with('otherCategories', $otherCategories)
                    ->with('categorySection', $categorySection)
                    ->with('categoryLists', $categoryLists)
                    ->with('categoryProductPanelList', $categoryProductPanelList)
                    ->with('productList', array_flatten($product))
                    ->with('childCategoryLists', $childCategoryLists)
                    ->with('templateLists', array_flatten($this->getTemplates($this->temporarySliderMap->sliderTemplate)))
                    ->with('categoryNavigation', $categoryNavigation)
                    ->with('password', $adminObject->password)
                    ->with('sliderSection', $sliders)
                    ->with('topProducts', $topProducts)
                    ->with('topSellers', $topSellers)
                    ->with('newArrivals', $newArrivals)
                    ->with('adSection', array_flatten($adsSection))
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());                                                   
    }

    /**
     *  Reloads contents brands nodes
     */     
    public function getBrandsSection()
    {
        $topSellers = [];  

        $xmlString = $this->XMLService->getNewHomeXml();
        $this->map = simplexml_load_string(trim($xmlString));

        foreach($this->map->menu->topSellers as $tSellers)
        {
            $topSellers[] = $tSellers;
        }           
        $brandRepository = App::make("BrandRepository");

        $brandsLists = [];
        foreach($this->map->brandSection->brandId as $brands) 
        {
            $brandsLists[] = $brandRepository->getBrandById($brands);                  

        }  
        $adminRepo = App::make('AdminMemberRepository');            
        $adminObject = $adminRepo->getAdminMemberById(Auth::id());       

        return View::make('partials.brandsection')        
                    ->with('allBrandsLists', $brandRepository->getAllBrands())
                    ->with('brandsLists', $brandsLists)
                    ->with('userid', Auth::id())  
                    ->with('password', $adminObject->password)          
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());            

    }


    /**
     *  Reloads contents of ads nodes
     */ 
    public function getAdSection()
    {
        $adminRepo = App::make('AdminMemberRepository');  
        $adminObject = $adminRepo->getAdminMemberById(Auth::id());  
        $xmlString = $this->XMLService->getNewHomeXml();
        $this->map = simplexml_load_string(trim($xmlString));

        $adsSection = [];                  
        foreach($this->map->adSection as $ads) {
            $adsSection[] = $ads;
        }   
        return View::make('partials.adssection')        
                    ->with('adSection', array_flatten($adsSection))
                    ->with('userid', Auth::id())  
                    ->with('password', $adminObject->password)          
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());          
    }

    /**
     *  Reloades categoriesPanel
     */ 
    public function getCategoriesProductPanel($index, $subIndex, $subPanelIndex)
    {
        $index = (int) $index;
        $subIndex = (int) $subIndex;
        $xmlString = $this->XMLService->getNewHomeXml();
        $this->map = simplexml_load_string(trim($xmlString));
        $categoryIndex = 0;
        $categoryProductPanel = [];
        $categoryProductPanelList = [];
        $categorySection = [];
        foreach($this->map->categorySection as $categoryPanel)
        {
            foreach($categoryPanel->sub as $productPanel)
            {
                foreach ($productPanel->productSlugs as $slug) {
                    $productObj = $this->productRepository->getProductBySlug($slug);
                    if(count($productObj) > 0) {
                        $categoryProductPanel[] = $productObj;
                    }                    
                }
                $categoryProductPanelList[] = array_flatten([
                    $categoryIndex => $categoryProductPanel 
                ]);
                $categoryIndex++;
                $categoryProductPanel = [];                
            }
            $categorySection[] = $categoryPanel;
        }

        return View::make('partials.categorysectionproductpanel')        
                    ->with('categoryPanel', $categorySection)
                    ->with('categorySectionIndex', $index)
                    ->with('subIndex', $subPanelIndex)
                    ->with('subCategorySection', $subIndex)
                    ->with('categoryProductPanelList', $categoryProductPanelList)                    
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());                      
             
    }

    /**
     *  Reloads sub categories
     */ 
    public function getSubCategoryNavigation($index)
    {
        $index = (int) $index;
        $subCategoryNavigation = [];     

        $xmlString = $this->XMLService->getNewHomeXml();
        $this->map = simplexml_load_string(trim($xmlString));

        foreach($this->map->categoryNavigation->category[$index]->sub as $subCategories)
        {
            $subCategoryNavigation[] = $subCategories;   
        }
        return View::make('partials.subcategorynavigation')        
                    ->with('index', $index)
                    ->with('subCategoryNavigation', $subCategoryNavigation[0])
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());                    
             
    }

    /**
     *  Reloads contents of productPanel
     */ 
    public function getProductPanel()
    {
        $adminRepo = App::make('AdminMemberRepository');
        $adminObject = $adminRepo->getAdminMemberById(Auth::id());                    
        $productEntity = App::make('ProductRepository');
        $product = [];  

        $xmlString = $this->XMLService->getNewHomeXml();
        $this->map = simplexml_load_string(trim($xmlString));

        foreach($this->map->sellerSection->productPanel as $productPanel)
        {
            $productObj = $productEntity->getProductBySlug($productPanel->slug);   
            if(count($productObj) > 0) {
                $product[] = $productObj;
            }      
            
        }

        return View::make('partials.productpanel')        
                    ->with('productList',array_flatten($product))
                    ->with('userid', Auth::id())  
                    ->with('password', $adminObject->password)          
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());  
    }

    /**
     *  Reloads contents of slideSectionPanel
     */ 
    public function getSlideSection($index)
    {
        $index = (int)$index;
        $adminRepo = App::make('AdminMemberRepository');
        $adminObject = $adminRepo->getAdminMemberById(Auth::id());          
        $sliderXmlString = $this->XMLService->getTempHomeXml();
        $this->map = simplexml_load_string(trim($sliderXmlString));

        $sliderXmlString = $this->XMLService->getTempHomeXml();
        $this->temporarySliderMap = simplexml_load_string(trim($sliderXmlString)); 

        $sliders = [];
        foreach($this->map->sliderSection->slide[$index]->image as $slides) {
            $sliders[] = $slides;
        }

        return View::make('partials.slidersectionpanel')        
                    ->with('sliderIndex', $index)
                    ->with('slides', $sliders)
                    ->with('userid', Auth::id())  
                    ->with('password', $adminObject->password)    
                    ->with('templateLists', array_flatten($this->getTemplates($this->temporarySliderMap->sliderTemplate)))                    
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());  
    }

    /**
     *  Fetches and reloads contents of sliders nodes
     */ 
    public function getAllSliders()
    {
        $adminRepo = App::make('AdminMemberRepository'); 
        $adminObject = $adminRepo->getAdminMemberById(Auth::id());  
        $sliderXmlString = $this->XMLService->getTempHomeXml();
        $this->map = simplexml_load_string(trim($sliderXmlString));  

        $sliderXmlString = $this->XMLService->getTempHomeXml();
        $this->temporarySliderMap = simplexml_load_string(trim($sliderXmlString)); 

        $sliders = [];
        foreach($this->map->sliderSection->slide as $slides) {
            $sliders[] = $slides;
        }
        return View::make('partials.slidersection')        
                    ->with('sliderSection', $sliders)
                    ->with('userid', Auth::id())  
                    ->with('password', $adminObject->password)    
                    ->with('templateLists', array_flatten($this->getTemplates($this->temporarySliderMap->sliderTemplate)))                    
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());  
    }

    /**
     *  Reloads contents of otherCategories nodes
     */     
    public function getOtherCategories()
    {
        $adminRepo = App::make('AdminMemberRepository');
        $adminObject = $adminRepo->getAdminMemberById(Auth::id());         
        $categoryRepository = App::make('CategoryRepository');  
        $otherCategories = [];       

        $xmlString = $this->XMLService->getNewHomeXml();
        $this->map = simplexml_load_string(trim($xmlString));

        foreach($this->map->categoryNavigation->otherCategories as $map) {
            $otherCategories[] = $map;            
        }   
        $childCategoryLists = [];
        foreach ($categoryRepository->getChildCategories() as $value) {
            $childCategoryLists[] = [
                "slug" => $value->slug, 
                "name" => $value->name
            ];
        }           

        return View::make('partials.othercategories')
                    ->with('userid', Auth::id())
                    ->with('password', $adminObject->password)                       
                    ->with('otherCategories', $otherCategories)
                    ->with('childCategoryLists', $childCategoryLists)
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());                                            
    }

    /**
     *  Reloads contents of otherCategories nodes
     */     
    public function getTopSellers()
    {
        $adminRepo = App::make('AdminMemberRepository');          
        $adminObject = $adminRepo->getAdminMemberById(Auth::id());  
        $xmlString = $this->XMLService->getNewHomeXml();
        $this->map = simplexml_load_string(trim($xmlString));

        $topSellers = [];        
        foreach($this->map->menu->topSellers as $tSellers)
        {
            $topSellers[] = $tSellers;
        }
        
        return View::make('partials.topsellers')
                    ->with('userid', Auth::id())
                    ->with('password', $adminObject->password)                       
                    ->with('topSellers', $topSellers)
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());                                            
    } 

    /**
     *  Reloads contents of otherCategories nodes
     */     
    public function getTopProducts()
    {
        $adminRepo = App::make('AdminMemberRepository');
        $adminObject = $adminRepo->getAdminMemberById(Auth::id());          
        $topProducts = [];   

        $xmlString = $this->XMLService->getNewHomeXml();
        $this->map = simplexml_load_string(trim($xmlString));

        foreach($this->map->menu->topProducts as $tProducts)
        {
            $topProducts[] = $tProducts;
        }
        
        return View::make('partials.topproducts')
                    ->with('userid', Auth::id())
                    ->with('password', $adminObject->password)                       
                    ->with('topProducts', $topProducts)
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());                                            
    }    

    /**
     *  Reloads contents of otherCategories nodes
     */     
    public function getNewArrivals()
    {
        $adminRepo = App::make('AdminMemberRepository'); 
        $adminObject = $adminRepo->getAdminMemberById(Auth::id());           
        $newArrivals = [];           

        $xmlString = $this->XMLService->getNewHomeXml();
        $this->map = simplexml_load_string(trim($xmlString));

        foreach($this->map->menu->newArrivals[0] as $arrivals)
        {
            $newArrivals[] = $arrivals;
        }
        
        return View::make('partials.newarrivals')
                    ->with('userid', Auth::id())
                    ->with('password', $adminObject->password)                       
                    ->with('newArrivals', $newArrivals)
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());                                            
    }   

    /**
     * Return iframe partial view for slider preview
     */
    public function getSliderPreview()
    {
        $adminRepo = App::make('AdminMemberRepository');
        $adminObject = $adminRepo->getAdminMemberById(Auth::id());                        
        $html =  View::make("partials.sliderpreview")
                    ->with("newHomeCmsLink",$this->XMLService->getNewHomeCmsLink())
                    ->with('userid', Auth::id())
                    ->with('hash', Input::get("hash"))
                    ->with('commit', Input::get("commit"))
                    ->with('password', $adminObject->password)                    
                    ->render();
        return Response::json(['html' => $html]);           
                    
    }
    
    /**
     *  Reloads contents of categoriesSection nodes
     */ 
    public function getAllCategories()
    {
        $adminRepo = App::make('AdminMemberRepository');    
        $adminObject = $adminRepo->getAdminMemberById(Auth::id());    

        $categoryRepository = App::make('CategoryRepository');          
        $productEntity = App::make('ProductRepository');

        $xmlString = $this->XMLService->getNewHomeXml();
        $this->map = simplexml_load_string(trim($xmlString));

        $categoryProductPanel = [];        
        $categoryProductPanelList = [];        
        $categorySection = [];
        $index = 0;

        foreach($this->map->categorySection as $categoryPanel)
        {
            foreach($categoryPanel->sub as $productPanel)
            {
                foreach ($productPanel->productSlugs as $slug) {
                    $productObj = $this->productRepository->getProductBySlug($slug);
                    if(count($productObj) > 0) {
                        $categoryProductPanel[] = $productObj;
                    }                    
                }
                $categoryProductPanelList[] = array_flatten([
                    $index => $categoryProductPanel 
                ]);
                $index++;
                $categoryProductPanel = [];                
            }
            $categorySection[] = $categoryPanel;
        }



        foreach ($categoryRepository->getParentCategories() as $value) {
            $categoryLists[] = [
                "slug" => $value->slug, 
                "name" => $value->name
            ];
        }        

        return View::make('partials.categorysection')
                    ->with('userid', Auth::id())
                    ->with('categorySection', $categorySection)
                    ->with('categoryLists', $categoryLists)
                    ->with('categoryProductPanelList', $categoryProductPanelList)
                    ->with('password', $adminObject->password)
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());              

    }

    /**
     *  Returns template Lists
     *  @param object $templatesObj
     *  @return array 
     */
    public function getTemplates($templatesObj)
    {
        $templateLists = [];        
        foreach($templatesObj as $template) {
            $templateLists[] = $template;
        } 
        return $templateLists;
    }    

}
