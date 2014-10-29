<?php namespace Easyshop\Services;

class CustomPaginator
{
    /**
     * Make a custom paginator object for arrayData
     * @param array $arrayData
     * @param int $pageParameter
     * @param int $perPage
     * @return PAGINATOR Object
     */
    public function paginateArray($arrayData, $pageParameter, $perPage)
    {
        $currentPage = $pageParameter - 1;
        $pagedData = array_slice($arrayData, $currentPage * $perPage, $perPage);
        return \Paginator::make($pagedData, count($arrayData), $perPage);  
    }


}
