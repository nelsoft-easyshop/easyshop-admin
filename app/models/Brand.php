<?php

class Brand extends Eloquent
{
    protected $table = 'es_brand';
    protected $primaryKey = 'id_brand';

    public function product()
    {
        return $this->hasOne('Product');
    }
}
