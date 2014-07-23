<?php

class Address extends Eloquent {

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'es_address';
	
	/*
	* The primary key of the table
	*
	*/
	
	protected $primaryKey = 'id_address';


	public function city() {
		return $this->hasOne('LocationLookUp');
	}

	public function country() {
		return $this->hasOne('LocationLookUp');
	}

	public function region() {
		return $this->hasOne('LocationLookUp');
	}
	
	public function member() {
		return $this->hasOne('Member');
	}
	

}
