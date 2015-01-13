<?php

use Easyshop\Services\XMLContentGetterService as XMLService;

class ProductController extends BaseController
{
    protected $XMLService;

    public function __construct(XMLService $XMLService)
    {
        $this->XMLService = $XMLService;
    }

    /**
     * Get all products
     * @return Entity
     */
    public function showAllItems()
    {
        $productData = [
            'item' => Input::get('item'),
            'category' => Input::get('category'),
            'brand' => Input::get('brand'),
            'condition' => Input::get('condition'),
            'seller' => Input::get('seller'),
            'startdate' => Input::get('startdate'),
            'enddate' => Input::get('enddate')
        ];

        $products = App::make('ProductRepository')->search($productData, 5);
        $pagination = $products->appends(Input::except(['page','_token']))->links();
        return View::make('pages.itemlist')
                    ->with('pagination', $pagination)
                    ->with('list_of_items', $products)
                    ->with('easyShopLink',$this->XMLService->GetEasyShopLink());
    }

}
