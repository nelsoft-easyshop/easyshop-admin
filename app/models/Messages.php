<?php

class Messages extends Eloquent 
{

   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'es_messages';
    protected $primaryKey = 'id_msg';
    public $timestamps = false;
}

