<?php

class Style extends Eloquent 
{

   /**
    * The database table used by the model.
    *
    * @var string
    */
   
    const DEFAULT_STYLE_ID = 1;

    protected $table = 'es_style';
    protected $primaryKey = 'id_style';
    public $timestamps = false;
}

