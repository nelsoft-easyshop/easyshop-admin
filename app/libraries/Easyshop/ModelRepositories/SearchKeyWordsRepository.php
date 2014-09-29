<?php namespace Easyshop\ModelRepositories;

use SearchKeywords;
use Illuminate\Support\Facades\DB;

class SearchKeyWordsRepository
{

    /**
     *  Renders all keywords
     *
     *  @return Entity
     */
    public function listAllKeyWords($row)
    {

        $keywords = DB::table('es_keywords_temp')
                         ->select('keywords', DB::raw('count(*) as hits'))
                         ->groupBy('keywords')
                         ->orderBy('hits','desc')                         
                         ->paginate($row);
        return $keywords;          
    }

    /**
     *  Returns custom search
     *
     *  @return Entity
     */
    public function searchKey($keyword, $row)
    {
   
        $keywords = DB::table('es_keywords_temp')
                         ->select('keywords', DB::raw('count(*) as hits'))
                         ->groupBy('keywords')
                         ->orderBy('hits','desc')
                         ->where('keywords', 'LIKE', "%$keyword%")
                         ->paginate($row);
        $keywords->setBaseUrl("searchkeywords");
        return $keywords;          
    }


    
}

