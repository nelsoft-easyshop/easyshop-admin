<?php

use Easyshop\Services\XMLContentGetterService as XMLService;

class NewHomeContentManagerController extends BaseController 
{
    /**
     *  Constructor declaration for XMLService  
     */
    protected $XMLService;

    public function __construct(XMLService $XMLService) 
    {   
        $this->XMLService = $XMLService;
        $xmlString = $this->XMLService->getNewHomeXml();
        $this->map = simplexml_load_string(trim($xmlString));
    
    }      
      
    /**
     *  Organizes and retrieves contents from home_files.xml
     */      
    public function getHomeContent()
    {

        foreach($this->map->categoryNavigation->otherCategories as $map) {
            $otherCategories[] = $map;
        }        

        foreach($this->map->categoryNavigation->category as $map) {
            $categoryNavigation[] = $map;
        }         

        $adminEntity = App::make('AdminMemberRepository');          
        $categoryRepository = App::make('CategoryRepository');          

        foreach ($categoryRepository->getParentCategories() as $value) {
            $categoryLists[] = array("slug" => $value->slug, "name" => $value->name);
        }

        foreach ($categoryRepository->getChildCategories() as $value) {
            $childCategoryLists[] = array("slug" => $value->slug, "name" => $value->name);
        }               

        foreach($this->map->sliderSection->slide as $slides) {
            $sliders[] = $slides;
        }

        foreach($this->map->sliderTemplate as $template) {
            $templateLists[] = $template->template;
        } 

        foreach($this->map->adSection as $ads) {
            $adsSection[] = $ads;
        }     

        $productEntity = App::make('ProductRepository');
        foreach($this->map->sellerSection->productPanel as $productPanel)
        {
            $product[] = $productEntity->getProductBySlug($productPanel->slug);   
        }

        $index = 0;
        foreach($this->map->categorySection as $categoryPanel)
        {
            foreach($categoryPanel->productPanel as $productPanel)
            {
                $categoryProductPanel[] = $productEntity->getProductBySlug($productPanel->slug);
            }
            $categorySection[] = $categoryPanel;   
            $categoryProductPanelList[] = array_flatten(array($index => $categoryProductPanel ));
            $index++;
            $categoryProductPanel = array();
        }

        foreach($this->map->menu->newArrivals[0] as $arrivals)
        {
            $newArrivals[] = $arrivals;
        }

        foreach($this->map->menu->topProducts as $tProducts)
        {
            $topProducts[] = $tProducts;
        }   

        foreach($this->map->menu->topSellers as $tSellers)
        {
            $topSellers[] = $tSellers;
        }           
        $brandRepository = App::make("BrandRepository");


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
                    ->with('templateLists', $templateLists)
                    ->with('categoryNavigation', $categoryNavigation)
                    ->with('password', $adminEntity->getAdminMemberById(Auth::id()))
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
        foreach($this->map->menu->topSellers as $tSellers)
        {
            $topSellers[] = $tSellers;
        }           
        $brandRepository = App::make("BrandRepository");


        foreach($this->map->brandSection->brandId as $brands) 
        {
            $brandsLists[] = $brandRepository->getBrandById($brands);                  

        }   
        $adminEntity = App::make('AdminMemberRepository');            

        return View::make('partials.brandsection')        
                    ->with('allBrandsLists', $brandRepository->getAllBrands())
                    ->with('brandsLists', $brandsLists)
                    ->with('userid', Auth::id())  
                    ->with('password', $adminEntity->getAdminMemberById(Auth::id()))          
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());            

    }


    /**
     *  Reloads contents of ads nodes
     */ 
    public function getAdSection()
    {
        $adminEntity = App::make('AdminMemberRepository');            
        foreach($this->map->adSection as $ads) {
            $adsSection[] = $ads;
        }   
        return View::make('partials.adssection')        
                    ->with('adSection', array_flatten($adsSection))
                    ->with('userid', Auth::id())  
                    ->with('password', $adminEntity->getAdminMemberById(Auth::id()))          
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());          
    }

    /**
     *  Reloades categoriesPanel
     */ 
    public function getCategoriesProductPanel($index)
    {
        $index = (int) $index;
        $productEntity = App::make('ProductRepository');
        $categoryIndex = 0;
        foreach($this->map->categorySection as $categoryPanel)
        {

            foreach($categoryPanel->productPanel as $productPanel)
            {
                $categoryProductPanel[] = $productEntity->getProductBySlug($productPanel->slug);
            }
            $categorySection[] = $categoryPanel;   
            $categoryProductPanelList[] = array_flatten(array($categoryIndex => $categoryProductPanel ));
            $categoryIndex++;
            $categoryProductPanel = array();
        }

        return View::make('partials.categorysectionproductpanel')        
                    ->with('categoryPanel', $categorySection)
                    ->with('categorySectionIndex', $index)
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
     *  Reloads sub categories
     */ 
    public function getSubCategoriesSection($index)
    {
        $index = (int) $index;
        $adminEntity = App::make('AdminMemberRepository');            
        foreach($this->map->categorySection[$index]->sub as $subCategories)
        {
            $categorySection[] = $subCategories;   
        }
        return View::make('partials.subcategoriessection')        
                    ->with('categoryPanel', $categorySection)
                    ->with('categorySectionIndex', $index)
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());                      
             
    }

    /**
     *  Reloads contents of productPanel
     */ 
    public function getProductPanel()
    {
        $adminEntity = App::make('AdminMemberRepository');             
        $productEntity = App::make('ProductRepository');
        foreach($this->map->sellerSection->productPanel as $productPanel)
        {
            $product[] = $productEntity->getProductBySlug($productPanel->slug);
            
        }

        return View::make('partials.productpanel')        
                    ->with('productList',array_flatten($product))
                    ->with('userid', Auth::id())  
                    ->with('password', $adminEntity->getAdminMemberById(Auth::id()))          
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());  
    }

    /**
     *  Reloads contents of slideSectionPanel
     */ 
    public function getSlideSection($index)
    {
        $index = (int)$index;
        $adminEntity = App::make('AdminMemberRepository');             
        foreach($this->map->sliderTemplate as $template) {
            $templateLists[] = $template->template;
        }        

        foreach($this->map->sliderSection->slide[$index]->image as $slides) {
            $sliders[] = $slides;
        }

        return View::make('partials.slidersectionpanel')        
                    ->with('sliderIndex', $index)
                    ->with('slides', $sliders)
                    ->with('userid', Auth::id())  
                    ->with('password', $adminEntity->getAdminMemberById(Auth::id()))    
                    ->with('templateLists', $templateLists)                    
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());  
    }

    /**
     *  Fetches and reloads contents of sliders nodes
     */ 
    public function getAllSliders()
    {
        $adminEntity = App::make('AdminMemberRepository');             
        foreach($this->map->sliderTemplate as $template) {
            $templateLists[] = $template->template;
        }        

        foreach($this->map->sliderSection->slide as $slides) {
            $sliders[] = $slides;
        }
        return View::make('partials.slidersection')        
                    ->with('sliderSection', $sliders)
                    ->with('userid', Auth::id())  
                    ->with('password', $adminEntity->getAdminMemberById(Auth::id()))    
                    ->with('templateLists', $templateLists)                    
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());  
    }

    /**
     *  Reloads contents of otherCategories nodes
     */     
    public function getOtherCategories()
    {
        $adminEntity = App::make('AdminMemberRepository');          
        $categoryRepository = App::make('CategoryRepository');              
        foreach($this->map->categoryNavigation->otherCategories as $map) {
            $otherCategories[] = $map;            
        }   

        foreach ($categoryRepository->getChildCategories() as $value) {
            $childCategoryLists[] = array("slug" => $value->slug, "name" => $value->name);
        }           

        return View::make('partials.othercategories')
                    ->with('userid', Auth::id())
                    ->with('password', $adminEntity->getAdminMemberById(Auth::id()))                       
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
        $adminEntity = App::make('AdminMemberRepository');          
        foreach($this->map->menu->topSellers as $tSellers)
        {
            $topSellers[] = $tSellers;
        }
        
        return View::make('partials.topsellers')
                    ->with('userid', Auth::id())
                    ->with('password', $adminEntity->getAdminMemberById(Auth::id()))                       
                    ->with('topSellers', $topSellers)
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());                                            
    } 

    /**
     *  Reloads contents of otherCategories nodes
     */     
    public function getTopProducts()
    {
        $adminEntity = App::make('AdminMemberRepository');          
        foreach($this->map->menu->topProducts as $tProducts)
        {
            $topProducts[] = $tProducts;
        }
        
        return View::make('partials.topproducts')
                    ->with('userid', Auth::id())
                    ->with('password', $adminEntity->getAdminMemberById(Auth::id()))                       
                    ->with('topProducts', $topProducts)
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());                                            
    }    

    /**
     *  Reloads contents of otherCategories nodes
     */     
    public function getNewArrivals()
    {
        $adminEntity = App::make('AdminMemberRepository');          
        foreach($this->map->menu->newArrivals[0] as $arrivals)
        {
            $newArrivals[] = $arrivals;
        }
        
        return View::make('partials.newarrivals')
                    ->with('userid', Auth::id())
                    ->with('password', $adminEntity->getAdminMemberById(Auth::id()))                       
                    ->with('newArrivals', $newArrivals)
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());                                            
    }    

    /**
     *  Reloads contents of categoriesSection nodes
     */ 
    public function getAllCategories()
    {
        $adminEntity = App::make('AdminMemberRepository');          
        $categoryRepository = App::make('CategoryRepository');          
        $productEntity = App::make('ProductRepository');

        $index = 0;
        foreach($this->map->categorySection as $categoryPanel)
        {

            foreach($categoryPanel->productPanel as $productPanel)
            {
                $categoryProductPanel[] = $productEntity->getProductBySlug($productPanel->slug);
            }
            $categorySection[] = $categoryPanel;   
            $categoryProductPanelList[] = array_flatten(array($index => $categoryProductPanel ));
            $index++;
            $categoryProductPanel = array();
        }  
        foreach ($categoryRepository->getParentCategories() as $value) {
            $categoryLists[] = array("slug" => $value->slug, "name" => $value->name);
        }        

        return View::make('partials.categorysection')
                    ->with('userid', Auth::id())
                    ->with('categorySection', $categorySection)
                    ->with('categoryLists', $categoryLists)
                    ->with('categoryProductPanelList', $categoryProductPanelList)
                    ->with('password', $adminEntity->getAdminMemberById(Auth::id()))
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());              

    }
}
