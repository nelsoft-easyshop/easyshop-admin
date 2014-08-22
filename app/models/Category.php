<?php

class Category extends Eloquent
{
    protected $table = 'es_cat';
    protected $primaryKey = 'id_cat';

    public function product()
    {
        return $this->hasOne('Product');
    }
}
