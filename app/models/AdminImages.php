<?php

class AdminImages extends Eloquent 
{

   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'es_admin_images';

   /**
    * The primary key of the table
    *
    */
    protected $primaryKey = 'id_admin_image';
    public $timestamps = false;    
}
