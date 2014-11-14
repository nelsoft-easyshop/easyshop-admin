<?php

class TagType extends Eloquent 
{

    const NOTAG = 0;
    const CONTACTED = 1;
    const REFUND = 2;
    const ON_HOLD = 3;
    const PAYOUT = 4; 
    const CONFIRMED = 5; 

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
