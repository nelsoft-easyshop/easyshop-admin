<?php

class TagType extends Eloquent 
{

    const CONTACTED = 1;
    const REFUND = 2;
    const ON_HOLD = 3;
    const PAYOUT = 4; 

   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'es_tag_type';

    /**
     * The primary key of the table
     *
     */
    protected $primaryKey = 'id_tag_type';
}