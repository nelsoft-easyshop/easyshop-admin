<?php

class ApiType extends Eloquent 
{

    const TYPE_IOS = 1;
    const TYPE_ANDROID = 2;

   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'es_api_type';

   /**
    * The primary key of the table
    *
    */
    protected $primaryKey = 'id_api_type';
}
