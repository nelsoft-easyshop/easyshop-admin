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
        $searchkeywordRepository = App::make('SearchKeyWordsRepository');
        $keywordsResult = $searchkeywordRepository->listAllKeyWords(Input::get("keyword"), 150);
        $pagination = $keywordsResult->appends(Input::except(['page','_token']))->links();
        return View::make('pages.searchkeywords')
            ->with('list_of_keywords', $keywordsResult)
            ->with('pagination', $pagination);
    }
}


