<?php

class Point extends Eloquent 
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'es_point';

    /**
     * The primary key of the table
     *
     * @var string
     */
    protected $primaryKey = 'id';
    
    /**
     * Disable table auto timestamping
     *
     * @var boolean
     */
    public $timestamps = false;   
       
}
