<?php
class ProductController extends BaseController
{
    public function showAllItems()
    {
        return View::make('pages.itemlist')
            ->with(
                'list_of_items',
                App::make('ProductRepository')
                    ->getAll(100)
            );
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
            ->with('list_of_items', App::make('ProductRepository')->search($userData));
    }
}
