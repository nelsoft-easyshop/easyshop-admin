<?php


class Product extends Eloquent 
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'es_product';

    /**
     * The primary key of the table
     *
     */

    protected $primaryKey = 'id_product';
    
    /**
     * Disable timestamps
     *
     */
    public $timestamps = false;
    
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
    
    public function productImages()
    {
        return $this->hasMany('ProductImage', 'product_id', 'id_product');
    }
    
}
