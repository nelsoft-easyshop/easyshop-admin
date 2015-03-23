<?php

use Easyshop\Services\XMLContentGetterService as XMLService;
use Easyshop\ModelRepositories\ProductRepository as ProductRepository;
use Easyshop\ModelRepositories\AdminMemberRepository as AdminMemberRepository;
use Easyshop\ModelRepositories\CategoryRepository as CategoryRepository;
use Easyshop\ModelRepositories\BrandRepository as BrandRepository;
use Easyshop\ModelRepositories\ProductImageRepository as ProductImageRepository;

class NewHomeContentManagerController extends BaseController 
{
    /**
     *  Constructor declaration for XMLService  
     */
    protected $XMLService;

    /**
     *  The Product Repository
     */    
    protected $productRepository;

    /**
     *  Assets link return by the easyshop application
     */
    protected $assetLink;    

    /**
     *  The Administratory Repository
     */      
    protected $adminMemberRepository;

    /**
     *  The Category Repository
     */      
    protected $categoryRepository;

    /**
     *  The Category Repository
     */      
    protected $brandRepository;    

    /**
     *  The Product Image Repository
     */ 
    protected $productImageRepository;
    
    public function __construct(XMLService $XMLService,
                                ProductRepository $productRepository,
                                AdminMemberRepository $adminMemberRepository, 
                                CategoryRepository $categoryRepository,
                                BrandRepository $brandRepository,
                                ProductImageRepository $productImageRepository) 
    {   
        $this->XMLService = $XMLService;
        $this->assetLink = trim($this->XMLService->getAssetsLink()) === "/" ? $this->XMLService->GetEasyShopLink() : 
                           rtrim($this->XMLService->getAssetsLink(),"/");
        $this->XMLService = $XMLService;    
        $this->productRepository = $productRepository;    
        $this->adminMemberRepository = $adminMemberRepository;    
        $this->categoryRepository = $categoryRepository;    
        $this->brandRepository = $brandRepository;    
        $this->productImageRepository = $productImageRepository;   
    }      
      
    /**
     *  Organizes and retrieves contents from home_files.xml
     */      
    public function getHomeContent()
    {
        $adminObject = $this->adminMemberRepository->getAdminMemberById(Auth::id()); 

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


        $categoryLists = [];
        foreach ($this->categoryRepository->getParentCategories() as $value) {
            $categoryLists[] = [
                "slug" => $value->slug, 
                "name" => $value->name
            ];
        }

        $childCategoryLists = [];
        foreach ($this->categoryRepository->getChildCategories() as $value) {
            $childCategoryLists[] = [
                "slug" => $value->slug, 
                "name" => $value->name." (" .$value->description.")"
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
        foreach($this->map->sellerSection->productPanel as $productPanel)
        {
            $productObj = $this->productRepository->getProductBySlug($productPanel->slug);   
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

        $brandsLists = [];
        foreach($this->map->brandSection->brandId as $brands) 
        {
            $brandsLists[] = $this->brandRepository->getBrandById($brands);                  

        }

        return View::make('pages.cms-newhome')
                    ->with('userid', Auth::id())
                    ->with('allBrandsLists', $this->brandRepository->getAllBrands())
                    ->with('brandsLists', $brandsLists)
                    ->with('otherCategories', $otherCategories)
                    ->with('sellerSection', $this->map->sellerSection)
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
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink())                                                   
                    ->with('assetLink',$this->assetLink);
    }

    /**
     * Retrieves Seller Section
     * @return VIEW
     */
    public function getSellerSection()
    {
        $xmlString = $this->XMLService->getNewHomeXml();        
        $this->map = simplexml_load_string(trim($xmlString));
        return View::make('partials.sellersection')
                    ->with('sellerSection', $this->map->sellerSection)
                    ->with('userid', Auth::id())
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink())
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink());
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

        $brandsLists = [];
        foreach($this->map->brandSection->brandId as $brands) 
        {
            $brandsLists[] = $this->brandRepository->getBrandById($brands);                  

        }  

        return View::make('partials.brandsection')        
                    ->with('allBrandsLists', $this->brandRepository->getAllBrands())
                    ->with('brandsLists', $brandsLists)
                    ->with('userid', Auth::id())  
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());            

    }


    /**
     *  Reloads contents of ads nodes
     */ 
    public function getAdSection()
    {
        $xmlString = $this->XMLService->getNewHomeXml();
        $this->map = simplexml_load_string(trim($xmlString));

        $adsSection = [];                  
        foreach($this->map->adSection as $ads) {
            $adsSection[] = $ads;
        }   
        return View::make('partials.adssection')        
                    ->with('adSection', array_flatten($adsSection))
                    ->with('userid', Auth::id())  
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink())
                    ->with('assetLink',$this->assetLink);
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
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink())
                    ->with('assetLink',$this->assetLink);                                     
             
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
        $product = [];

        $xmlString = $this->XMLService->getNewHomeXml();
        $this->map = simplexml_load_string(trim($xmlString));

        foreach($this->map->sellerSection->productPanel as $productPanel)
        {
            $productObj = $this->productRepository->getProductBySlug($productPanel->slug);   
            if(count($productObj) > 0) {
                $product[] = $productObj;
            }      
            
        }

        return View::make('partials.productpanel')        
                    ->with('productList',array_flatten($product))
                    ->with('userid', Auth::id())  
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink())
                    ->with('assetLink',$this->assetLink);                     
    }

    /**
     *  Reloads contents of slideSectionPanel
     */ 
    public function getSlideSection($index)
    {
        $index = (int)$index;
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
                    ->with('templateLists', array_flatten($this->getTemplates($this->temporarySliderMap->sliderTemplate)))                    
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink())
                    ->with('assetLink',$this->assetLink);                    
    }

    /**
     *  Fetches and reloads contents of sliders nodes
     */ 
    public function getAllSliders()
    {
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
                    ->with('templateLists', array_flatten($this->getTemplates($this->temporarySliderMap->sliderTemplate)))                    
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink())
                    ->with('assetLink',$this->assetLink);                     
    }

    /**
     *  Reloads contents of otherCategories nodes
     */     
    public function getOtherCategories()
    {
        $otherCategories = [];

        $xmlString = $this->XMLService->getNewHomeXml();
        $this->map = simplexml_load_string(trim($xmlString));

        foreach($this->map->categoryNavigation->otherCategories as $map) {
            $otherCategories[] = $map;            
        }   
        $childCategoryLists = [];
        foreach ($this->categoryRepository->getChildCategories() as $value) {
            $childCategoryLists[] = [
                "slug" => $value->slug, 
                "name" => $value->name." (" .$value->description.")"
            ];
        }           

        return View::make('partials.othercategories')
                    ->with('userid', Auth::id())
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
        $xmlString = $this->XMLService->getNewHomeXml();
        $this->map = simplexml_load_string(trim($xmlString));

        $topSellers = [];        
        foreach($this->map->menu->topSellers as $tSellers)
        {
            $topSellers[] = $tSellers;
        }
        
        return View::make('partials.topsellers')
                    ->with('userid', Auth::id())
                    ->with('topSellers', $topSellers)
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());                                            
    } 

    /**
     *  Reloads contents of otherCategories nodes
     */     
    public function getTopProducts()
    {
        $topProducts = [];

        $xmlString = $this->XMLService->getNewHomeXml();
        $this->map = simplexml_load_string(trim($xmlString));

        foreach($this->map->menu->topProducts as $tProducts)
        {
            $topProducts[] = $tProducts;
        }
        
        return View::make('partials.topproducts')
                    ->with('userid', Auth::id())
                    ->with('topProducts', $topProducts)
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());                                            
    }    

    /**
     *  Reloads contents of otherCategories nodes
     */     
    public function getNewArrivals()
    {
        $newArrivals = [];

        $xmlString = $this->XMLService->getNewHomeXml();
        $this->map = simplexml_load_string(trim($xmlString));

        foreach($this->map->menu->newArrivals[0] as $arrivals)
        {
            $newArrivals[] = $arrivals;
        }
        
        return View::make('partials.newarrivals')
                    ->with('userid', Auth::id())
                    ->with('newArrivals', $newArrivals)
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())                    
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());                                            
    }   

    /**
     * Return iframe partial view for slider preview
     */
    public function getSliderPreview()
    {
        $html =  View::make("partials.sliderpreview")
                    ->with("newHomeCmsLink",$this->XMLService->getNewHomeCmsLink())
                    ->with('userid', Auth::id())
                    ->with('hash', Input::get("hash"))
                    ->with('commit', Input::get("commit"))
                    ->render();
        return Response::json(['html' => $html]);           
                    
    }
    
    /**
     *  Reloads contents of categoriesSection nodes
     */ 
    public function getAllCategories()
    {
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



        foreach ($this->categoryRepository->getParentCategories() as $value) {
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
                    ->with('newHomeCmsLink', $this->XMLService->getNewHomeCmsLink())
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink())
                    ->with('assetLink',$this->assetLink);

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
