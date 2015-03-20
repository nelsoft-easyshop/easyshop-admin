<?php

class DeviceToken extends Eloquent 
{
   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'es_device_token';

   /**
    * The primary key of the table
    *
    */
    protected $primaryKey = 'id_device_token';
    public $timestamps = false;
}
