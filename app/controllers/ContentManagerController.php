<?php

use Easyshop\MyCalculations\Taxes\Tax;

  
class ContentManagerController extends BaseController 
{
    

    public function getHomeContent()
    {
        $id = Auth::id();
        $xmlString = file_get_contents("https://easyshop.ph.feature/webservice/homewebservice/getContents/");
        $map = simplexml_load_string(trim($xmlString));

        $productEntity = App::make('ProductRepository');
        $adminEntity = App::make('AdminRepository');

        foreach($map->productSlide as $slides)
        {

            $productSlides[] =  $productEntity->getProductBySlug($slides->value);
            $productTypes[] = $slides;
            $obj = json_encode(array_merge($productSlides,$productTypes));
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
        
        return View::make('pages.cms-home')
            ->with('adminPassword', $adminEntity->getAdmin($id))
            ->with('userId', $id)
            ->with('value',$map->text->value)
            ->with('productSlideTitle', $map->productSlide_title->value)
            ->with('productSideBanner', $map->productSideBanner->value)
            ->with('sectionHeads',  $sectionHeads)
            ->with('mainSlides',  $mainSlides)
            ->with('mainSlideId',  0)
            ->with('mainSlideCount',  count($mainSlides))
            ->with('productSlide',  json_encode($productSlides))
            ->with('slugs',  $productSlides)
            ->with('productSlideCount',  count($productTypes))
            ->with('productTypes',  json_encode($productTypes))
            ->with('productSlideId', 0 )
            ->with('sectionId', 0 )
            ->with('panelMainId', 0 )
            ->with('nodeTypes', $nodeTypes);
           
    }

    public function getMainSlides()
    {
        $id = Auth::id();
        $xmlString = file_get_contents("https://easyshop.ph.feature/webservice/homewebservice/getContents/");
        $map = simplexml_load_string(trim($xmlString));
        foreach($map->mainSlide as $slides)
        {
            $mainSlides[] =  $slides;
        }

        return View::make('includes.mainslides')
            ->with('userId', $id)
            ->with('mainSlides',$mainSlides)
            ->with('mainSlideId',0)
            ->with('mainSlideCount',  count($mainSlides));
    }

    public function getProductSlides()
    {
        $id = Auth::id();
        $xmlString = file_get_contents("https://easyshop.ph.feature/webservice/homewebservice/getContents/");
        $map = simplexml_load_string(trim($xmlString));
        $productEntity = App::make('ProductRepository');
        foreach($map->productSlide as $slides)
        {

            $productSlides[] =  $productEntity->getProductBySlug($slides->value);
            $productTypes[] = $slides;
            $obj = json_encode(array_merge($productSlides,$productTypes));
        }

        return View::make('includes.productslides')
            ->with('userId', $id)
            ->with('productSlide',  json_encode($productSlides))
            ->with('slugs',  $productSlides)
            ->with('productSlideCount',  count($productTypes))
            ->with('productTypes',  json_encode($productTypes))
            ->with('productSlideId', 0 );
    }

}
