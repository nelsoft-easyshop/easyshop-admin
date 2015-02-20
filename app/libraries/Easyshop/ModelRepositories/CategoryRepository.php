<?php namespace Easyshop\ModelRepositories;

use Category, Product;
use Illuminate\Support\Facades\DB;

class CategoryRepository
{
 
    /**
     * Get parent Categories
     * @return Entity
     */    
    public function getParentCategories()
    {
        return Category::where("parent_id","1")->get();
    }

    /**
     * Get child Categories
     * @return Entity
     */    
    public function getChildCategories()
    {
        return Category::where("parent_id","!=","1")->orderBy("name","asc")->get();

    }

    /**
     * Get total number of items per parent category
     *
     * @param $parentIds
     * @return Array
     */
    public function getProductCountPerParentCategory($parentIds)
    {   
        foreach ($parentIds as $parentId) {
            if($parentId->name === "PARENT"){
                continue;
            }
            $categoryname[] = $parentId->name;
            $childCategoryIds = array_keys($this->getChildrenWithNestedSet($parentId->id_cat));

            $count = DB::table("es_product")
                        ->whereIn("cat_id",$childCategoryIds)->count();
            $productCountPerCategory[] = $count;
        }

        return [
            "parentNames" => $categoryname,
            "productCount" => $productCountPerCategory
        ];
    }

    /**
     * Retrieves children categories using es_category_nested tabke
     * @param  int $categoryId
     * @return Array
     */
    public function getChildrenWithNestedSet($categoryId = Category::ROOT_CATEGORY_ID)
    {
        return DB::select(DB::raw("
                            SELECT 
                                t1.original_category_id AS original_category_id
                            FROM
                                es_category_nested_set t1
                                    LEFT JOIN
                                es_category_nested_set t2 ON t2.original_category_id = :category_id
                            WHERE
                                t1.left > t2.left
                                    AND t1.right < t2.right"),
                            ["category_id" => $categoryId]);
    }


    /**
     * Create category
     *
     * @param $data
     * @return Category Object
     */
    public function insert($data)
    {
        $category = new Category();
        $category->fill($data);
        $category->save();

        return $category;
    }

    /**
     *  Update a collection of category
     *
     *  @param $category
     *  @param array $data
     *  @return Category Object
     */
    public function update($category,$data)
    {
        $category->update($data);

        return $category;
    }

    /**
     * Get category object by its ID
     *
     * @param $id
     * @return Category object
     */
    public function getById($id)
    {
        return Category::find($id);
    }

    /**
     *  Retrieve child categories
     *
     *  @param $id
     *  @return Category Object
     */
    public function getChildById($id)
    {
        return Category::where('parent_id', '=', $id)
            ->where('id_cat', '>', 1)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     *  Retrieve parent categories
     *
     *  @param $id
     *  @return Category Object
     */
    public function getParentById($id)
    {
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

    /**
     * Search Category depending on the array content
     *
     * @param $userData
     * @return array
     */
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

    /**
     * Generate unique Slug
     * @param $product
     * @return string
     */
    public function generateSlug($product)
    {
        $category = new Category();
        $count = $category->where('es_cat.slug', 'LIKE', '%' . $product . '%')->count();
        if($count >= 1){
            $product = $product.$count;
        }

        return $product;
    }

}
