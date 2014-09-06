<?php

use Easyshop\Services\XMLContentGetterService as XMLService;

class ProductController extends BaseController
{
    protected $XMLService;

    public function __construct(XMLService $XMLService)
    {
        $this->XMLService = $XMLService;
    }

    public function showAllItems()
    {
        return View::make('pages.itemlist')
            ->with(
                'list_of_items',
                App::make('ProductRepository')
                    ->getAll(100)
            )
            ->with('easyShopLink',$this->XMLService->GetEasyShopLink());
    }

    public function doSearchItem()
    {
        $userData = array(
            'item' => Input::get('item'),
            'category' => Input::get('category'),
            'brand' => Input::get('brand'),
            'condition' => Input::get('condition'),
            'seller' => Input::get('seller'),
            'startdate' => Input::get('startdate'),
            'enddate' => Input::get('enddate')
        );

        return View::make('pages.itemlist')
            ->with('list_of_items', App::make('ProductRepository')->search($userData))
            ->with('easyShopLink',$this->XMLService->GetEasyShopLink())
            ->withInput(Input::flash());
    }
}
