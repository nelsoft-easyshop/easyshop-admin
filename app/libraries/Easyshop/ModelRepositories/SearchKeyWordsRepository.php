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
    public function listAllKeyWords($keyword = null, $row)
    {

        $query = DB::table('es_keywords_temp')
                         ->select('keywords', DB::raw('count(*) as hits'))
                         ->groupBy('keywords')
                         ->orderBy('hits','desc');

        if($keyword !== null) {
            $query->where('keywords', 'LIKE', "%$keyword%");
        }
        return $query->paginate($row);
    }
}


