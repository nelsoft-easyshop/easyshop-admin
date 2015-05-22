<?php

class Category extends Eloquent
{
    const ROOT_CATEGORY = 1;

    protected $table = 'es_cat';
    protected $primaryKey = 'id_cat';
    protected $fillable = array('id_cat', 'name', 'description', 'keywords', 'parent_id', 'sort_order', 'slug');
    public $timestamps = false;

    public function product()
    {
        return $this->hasOne('Product');
    }
}
