<?php

class Category extends Eloquent
{
    protected $table = 'es_cat';
    protected $primaryKey = 'id_cat';
    protected $fillable = array('id_cat', 'name', 'description', 'keywords', 'parent_id', 'sort_order', 'is_main');
    public $timestamps = false;

    public function product()
    {
        return $this->hasOne('Product');
    }
}
