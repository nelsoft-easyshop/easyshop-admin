<?php namespace Easyshop\ModelRepositories;

use Category;
use Easyshop\Services\StringHelperService;
use Illuminate\Support\Facades\DB;

class categoryRepository
{
    /**
     * Create category
     *
     * @param $data
     * @return Object
     */
    public function insert($data)
    {
        $category = new Category();
        $data['slug'] =  StringHelperService::clean($data['name']);
        $category->insert($data);

        return $this->getById(DB::getPdo()->lastInsertId());
    }

    /**
     *  Update a collection of category
     *
     *  @param Category $category
     *  @param array $data
     *  @return Object
     */
    public function update($category,$data)
    {
        $category->update($data);

        return $category;
    }

    public function getById($id)
    {
        return Category::find($id);
    }

    /**
     *  Get method for displaying child categories
     *
     *  @param string $id
     *  @return Object
     */
    public function getChildById($id)
    {
        if(!isset($id)){
            $id = 1;
        }
        return Category::where('parent_id', '=', $id)
            ->where('id_cat', '>', 1)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     *  GET method for displaying parent categories
     *
     *  @param string $id
     *  @return Object
     */
    public function getParentById($id)
    {
        if(!isset($id)){
            $id = 1;
        }
        $query = DB::select(DB::raw('
                    SELECT
                        T2.id_cat,
                        T2.name,
                        T2.slug
                    FROM
                        (SELECT
                            @r AS _id,
                            (SELECT
                                @r := parent_id
                            FROM
                                es_cat
                            WHERE id_cat = _id) AS parent_id,
                            @l := @l + 1 AS lvl
                        FROM
                            (SELECT
                                @r := ?,
                                @l := 0) vars,
                            es_cat h
                        WHERE @r != 1) T1
                        JOIN es_cat T2
                            ON T1._id = T2.id_cat
                    ORDER BY T1.lvl DESC'),array($id));

        return $query;
    }

    public function search($userData)
    {
        $member = Category::where('es_cat.id_cat', '>', 1);
        if($userData['category']){
            $member->where('es_cat.name', 'LIKE', '%' . $userData['category'] . '%');
        }
        if($userData['description']){
            $member->where('es_cat.description', 'LIKE', '%' . $userData['description'] . '%');
        }
        if($userData['keywords']){
            $member->where('es_cat.keywords', 'LIKE', '%' . $userData['keywords'] . '%');
        }
        if(($userData['startdate']) && ($userData['enddate'])){
            $member->where('es_member.datecreated', '>=', str_replace('/', '-', $userData['startdate']) . ' 00:00:00' )
                ->where('es_member.datecreated', '<=', str_replace('/', '-', $userData['enddate']) . ' 23:59:59', 'AND');
        }

        return $member->first();
    }

}
