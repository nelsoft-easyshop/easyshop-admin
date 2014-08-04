<?php
class Product extends Eloquent
{
    protected $table = 'es_product';
    protected $primaryKey = 'id_product';
    
    public function brand()
    {
        return $this->hasOne('Brand', 'id_brand', 'brand_id');
    }

    public function category()
    {
        return $this->hasOne('Category', 'id_cat', 'cat_id');
    }

    public function member()
    {
        return $this->hasOne('Member', 'id_member', 'member_id');
    }
}
