<?php

use Easyshop\Services\XMLContentGetterService as XMLService;



class ContentFilesManagerController extends BaseController 
{

    /**
     *  Constructor declaration for XMLService  
     *
     *  
     */
    protected $XMLService;

    public function __construct(XMLService $XMLService) 
    {   
        $this->XMLService = $XMLService;
    }

    /**
     *  GET method for displaying the retrieved xml contents
     *
     *  @return View
     */
    public function getContentFiles()
    {
        $id = Auth::id();
        $xmlString = $this->XMLService->GetXmlContentFiles();
        $map = simplexml_load_string(trim($xmlString));

        $adminEntity = App::make('AdminMemberRepository');
        

        foreach($map->feedFeaturedProduct->product as $products)
        {
            $feedfeaturedproducts[] =  $products;
        }
        foreach($map->feedPopularItems->product as $products)
        {
            $feedpopularitems[] =  $products;
        }
        foreach($map->feedPromoItems->product as $products)
        {
            $feedpromoitems[] =  $products;
        }
        foreach($map->select as $products)
        {
            
            $selectNodes[] =  $products;
        }
        return View::make('pages.cms-contents_files')
            ->with('contentCmsLink',$this->XMLService->GetContentCmsLink())
            ->with('adminPassword', $adminEntity->getAdminMemberById($id))
            ->with('feedFeaturedProduct', $feedfeaturedproducts)
            ->with('feedPopularItems', $feedpopularitems)
            ->with('feedPromoItems', $feedpromoitems)
            ->with('indexForEach', 0)
            ->with('featuredProductCount',  count($feedfeaturedproducts))
            ->with('popularItemsCount',  count($feedpopularitems))
            ->with('promoItemsCount',  count($feedpromoitems))
            ->with('leftBannerImg',  $map->feedBanner->left->img)
            ->with('leftBannerTarget',  $map->feedBanner->left->target)
            ->with('midBannerImg',  $map->feedBanner->mid->img)
            ->with('midBannerTarget',  $map->feedBanner->mid->target)
            ->with('rightBannerImg',  $map->feedBanner->right->img)
            ->with('rightBannerTarget',  $map->feedBanner->right->target)
            ->with('userId', $id)
            ->with('selectNodes', $selectNodes)
            ->with('collapse', 0);

         
    }
    /**
     *  GET method for displaying the xml contents for feedfeaturedproducts
     *
     *  @return View
     */
    public function getFeaturedProducts() 
    {
        $id = Auth::id();
        $xmlString = $this->XMLService->GetXmlContentFiles();
        $map = simplexml_load_string(trim($xmlString));

        $adminEntity = App::make('AdminMemberRepository');

        foreach($map->feedFeaturedProduct->product as $products)
        {
            $feedfeaturedproducts[] =  $products;
        }

        return View::make('partials.featuredproducts')
            ->with('contentCmsLink',$this->XMLService->GetContentCmsLink())
            ->with('adminPassword', $adminEntity->getAdminMemberById($id))
            ->with('feedFeaturedProduct', $feedfeaturedproducts)
            ->with('featuredProductCount',  count($feedfeaturedproducts))
            ->with('indexForEach', 0)
            ->with('collapse', 0)
            ->with('userId', $id);
    }
    /**
     *  GET method for displaying the xml contents for feedpopularitems
     *
     *  @return View
     */
    public function getPopularItems() 
    {
        $id = Auth::id();
        $xmlString = $this->XMLService->GetXmlContentFiles();
        $map = simplexml_load_string(trim($xmlString));

        $adminEntity = App::make('AdminMemberRepository');

        foreach($map->feedPopularItems->product as $products)
        {
            $feedpopularitems[] =  $products;
        }

        return View::make('partials.popularitems')
            ->with('contentCmsLink',$this->XMLService->GetContentCmsLink())
            ->with('adminPassword', $adminEntity->getAdminMemberById($id))
            ->with('feedPopularItems', $feedpopularitems)
            ->with('popularItemsCount',  count($feedpopularitems))
            ->with('indexForEach', 0)
            ->with('collapse', 0)
            ->with('userId', $id);

    }

    /**
     *  GET method for displaying the xml contents for feedprompitems
     *
     *  @return View
     */
    public function getPromoItems() 
    {
        $id = Auth::id();
        $xmlString = $this->XMLService->GetXmlContentFiles();
        $map = simplexml_load_string(trim($xmlString));

        $adminEntity = App::make('AdminMemberRepository');

        foreach($map->feedPromoItems->product as $products)
        {
            $feedpromoitems[] =  $products;
        }

        return View::make('partials.promoitems')
            ->with('contentCmsLink',$this->XMLService->GetContentCmsLink())
            ->with('adminPassword', $adminEntity->getAdminMemberById($id))
            ->with('feedPromoItems', $feedpromoitems)
            ->with('promoItemsCount',  count($feedpromoitems))
            ->with('indexForEach', 0)
            ->with('collapse', 0)
            ->with('userId', $id);


    }
}
