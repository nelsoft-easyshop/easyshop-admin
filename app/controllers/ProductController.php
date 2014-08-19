<?php
class ProductController extends BaseController
{
    public function showAllItems()
    {
        return View::make('pages.itemlist')
            ->with(
                'list_of_items',
                App::make('ProductRepository')
                    ->getAll(true)
                    ->paginate(100)
            );
    }
}
