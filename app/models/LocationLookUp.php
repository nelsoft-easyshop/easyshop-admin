<?php


class LocationLookUp extends Eloquent
{

    public static $TYPE= array(
        '0' => 0,
        '1' => 3,
        '2' => 4
    );

    protected $table = 'es_location_lookup';
    protected $primaryKey = 'id_location';
}
