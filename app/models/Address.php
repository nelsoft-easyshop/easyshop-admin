<?php

class Address extends Eloquent 
{

   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'es_address';

   /**
    * The primary key of the table
    *
    */
    protected $primaryKey = 'id_address';
    protected $fillable = array('city', 'stateregion', 'address', 'country', 'id_member');
    public $timestamps = false;

    public function city()
    {
        return $this->hasOne('LocationLookUp', 'id_location', 'city');
    }

    public function country()
    {
        return $this->hasOne('LocationLookUp', 'id_location', 'country');
    }

    public function region()
    {
        return $this->hasOne('LocationLookUp', 'id_location', 'stateregion');
    }

    public function member()
    {
        return $this->hasOne('Member');
    }
}

