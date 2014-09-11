<?php


class SearchKeyWordsController extends BaseController
{


    /**
     *  Render the search keywords page
     *
     *  @return View
     */
    public function showSearchKeyWords()
    {
        return View::make('pages.searchkeywords')
            ->with('list_of_keywords', SearchKeywords::paginate(50));

    }

    /**
     *  Performs custom search
     *
     *  @return JSON
     */
    public function customSearch()    
    {
        $searchkeywordRepository = App::make('SearchKeyWordsRepository');    
        $html =  View::make('partials.keywords')
                    ->with('list_of_keywords', $searchkeywordRepository->searchKey(Input::get("keyword"), 50, Input::get("order")))
                    ->render();
        return Response::json(array('html' => $html));                       
    }
  





}
