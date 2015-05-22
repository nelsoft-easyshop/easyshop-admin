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
     * @param Category[] $parentCatgeories
     * @return mixed
     */
    public function getProductCountPerParentCategory($parentCategories)
    {   
        
        $isNestedUsable = true;
        if((int)$this->getNestedSetCategoryCount() === 0 ) {
            $isNestedUsable = false;
        }

        foreach ($parentCategories as $parentCategory) {
            if( (int) $parentCategory->id_cat === Category::ROOT_CATEGORY){
                continue;
            }
            $categoryname[] = $parentCategory->name;
            if($isNestedUsable) {
                $childCategoryIds = [ $parentCategory->id_cat ];
                foreach ($this->getChildrenWithNestedSet($parentCategory->id_cat) as $value) {
                    $childCategoryIds[] = $value->original_category_id;
                }
                
            }
            else {
                $childCategoryIds = $this->getChildrenWithGetFamilyTree($parentCategory->id_cat);
            }

            $count = DB::table("es_product")
                       ->whereIn("cat_id",$childCategoryIds)
                       ->where('is_draft', Product::STATUS_NOT_DRAFTED)
                       ->where('is_delete', Product::STATUS_NOT_DELETED)
                       ->count();
            $productCountPerCategory[] = $count;
        }

        return [
            "parentNames" => $categoryname,
            "productCount" => $productCountPerCategory
        ];
    }

    /**
     * Retrieves number of products directly uploaded to a particular category
     * 
     * @param integer $categoryId
     * @return integer
     */
    public function getProductCountNonRecursive($categoryId)
    {
        $count = DB::table("es_product")
                   ->where("cat_id", $categoryId)
                   ->where('is_draft', Product::STATUS_NOT_DRAFTED)
                   ->where('is_delete', Product::STATUS_NOT_DELETED)
                   ->count();

        return $count;
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
                            AND 
                                t1.right < t2.right"),
                            ["category_id" => $categoryId]);
    }

    /**
     * Retrieves children categories using GetFamilyTree SQL function
     * @param  int $categoryId
     * @return Array
     */
    public function getChildrenWithGetFamilyTree($categoryId)
    {
        $childsList = DB::select(DB::raw("SELECT `GetFamilyTree`(:prodid) as childs"),
                                ["prodid" => $categoryId]);
        return explode(",",$childsList[0]->childs);
    }

    /**
     * Retrievs es_category_nested row count
     * @return int
     */
    public function getNestedSetCategoryCount()
    {
        $result =  DB::select(
            DB::raw("SELECT COUNT(*) as count FROM es_category_nested_set WHERE 1")
        );
        return $result[0]->count;
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



}
