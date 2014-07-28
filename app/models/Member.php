<?php

class Member extends Eloquent
{

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'es_member';
	protected $fillable = array('fullname','contactno','remarks','is_promo_valid');
	/*
	* The primary key of the table
	*
	*/
	
	protected $primaryKey = 'id_member';

    public function address()
    {
        return $this->hasOne('Address','id_member');
    }

    public function product($is_viewable=false)
    {
        if($is_viewable)
        {
            return $this->hasMany('Product','member_id')->where('is_delete','=',0,'AND')->where('is_draft','=',0,'AND');
        }

        return $this->hasMany('Product','member_id');
    }
}
