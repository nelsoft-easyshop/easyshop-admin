<?php namespace Easyshop\ModelRepositories;

use SearchKeywords;

class SearchKeyWordsRepository
{

    /**
     *  Returns search results
     *
     *  @return Entity
     */
    public function searchKey($keyword, $row, $order)
    {
        return SearchKeywords::where('keywords', 'LIKE', "%$keyword%")->orderBy("id_keywords_temp",$order)->paginate($row);   
    }
    
}

