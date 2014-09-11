<?php

class SearchKeywords extends Eloquent 
{

   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'es_keywords_temp';

   /**
    * The primary key of the table
    *
    */
    protected $primaryKey = 'id_keywords_temp';
}
