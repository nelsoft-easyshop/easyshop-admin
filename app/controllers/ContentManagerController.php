<?php

use Easyshop\Services\XMLContentGetterService as XMLService;



class ContentManagerController extends BaseController 
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
    public function getHomeContent()
    {
        $id = Auth::id();
        $xmlString = $this->XMLService->GetXmlContent();
        $map = simplexml_load_string(trim($xmlString));

        $productEntity = App::make('ProductRepository');
        $adminEntity = App::make('AdminMemberRepository');

        foreach($map->productSlide as $slides)
        {

            $productSlides[] =  $productEntity->getProductBySlug($slides->value);
            $productTypes[] = $slides;

        }

        foreach($map->section as $section)
        {
            $sectionHeads[] =  $section;
        }

        foreach($map->mainSlide as $slides)
        {
            $mainSlides[] =  $slides;
        }

        foreach($map->typeNode as $types)
        {
            $nodeTypes[] =  $types;
        }

        $productSlidesEncode = json_encode($productSlides);
        $productTypesEncode = json_encode($productTypes);

        $productSlidesDecode = json_decode($productSlidesEncode, TRUE);
        $productTypesDecode = json_decode($productTypesEncode, TRUE);


        return View::make('pages.cms-home')
            ->with('adminPassword', $adminEntity->getAdminMemberById($id))
            ->with('userId', $id)
            ->with('value',$map->text->value)
            ->with('productSlideTitle', $map->productSlide_title->value)
            ->with('productSideBanner', $map->productSideBanner->value)
            ->with('sectionHeads',  $sectionHeads)
            ->with('mainSlides',  $mainSlides)
            ->with('mainSlideId',  0)
            ->with('mainSlideCount',  count($mainSlides))
            ->with('productSlide',  $productSlidesDecode)
            ->with('slugs',  $productSlides)
            ->with('productSlideCount',  count($productTypes))
            ->with('productTypes',  $productTypesDecode)
            ->with('productSlideId', 0 )
            ->with('sectionId', -1 )
            ->with('panelMainId', 0 )
            ->with('collapse', 0 )
            ->with('nodeTypes', $nodeTypes);
           
    }

    /**
     *  GET method for displaying the xml contents for MainSlide
     *
     *  @return View
     */
    public function getMainSlides()
    {
        $id = Auth::id();

        $adminEntity = App::make('AdminMemberRepository');
        $xmlString = $this->XMLService->GetXmlContent();

        $map = simplexml_load_string(trim($xmlString));
        foreach($map->mainSlide as $slides)
        {
            $mainSlides[] =  $slides;
        }

        return View::make('partials.mainslides')
            ->with('adminPassword', $adminEntity->getAdminMemberById($id))

            ->with('userId', $id)
            ->with('mainSlides',$mainSlides)
            ->with('mainSlideId',0)
            ->with('mainSlideCount',  count($mainSlides));
    }

    /**
     *  GET method for displaying the xml contents for ProductSlides
     *
     *  @return View
     */
    public function getProductSlides()
    {
        $id = Auth::id();

        $adminEntity = App::make('AdminMemberRepository');
        $xmlString = $this->XMLService->GetXmlContent();
        $map = simplexml_load_string(trim($xmlString));

        $productEntity = App::make('ProductRepository');
        foreach($map->productSlide as $slides)
        {

            $productSlides[] =  $productEntity->getProductBySlug($slides->value);
            $productTypes[] = $slides;
        }

        return View::make('partials.productslides')
            ->with('adminPassword', $adminEntity->getAdminMemberById($id))

            ->with('userId', $id)
            ->with('productSlide',  json_encode($productSlides))
            ->with('slugs',  $productSlides)
            ->with('productSlideCount',  count($productTypes))
            ->with('productTypes',  json_encode($productTypes))
            ->with('productSlideId', 0 );
    }

}
