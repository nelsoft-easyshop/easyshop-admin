<?php

class Member extends Eloquent 
{

   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'es_member';
    protected $fillable = array('fullname', 'contactno', 'remarks', 'is_promo_valid');
    protected $primaryKey = 'id_member';
    public $timestamps = false;

    /**
     * Returns the address of a member
     * @return Address
     */
    public function address()
    {
        return $this->hasOne('Address', 'id_member');
    }

    /**
     * Returns the products of a certain member
     * @param boolean $isViewable
     * @return Product[]
     */
    public function product($isViewable=false)
    {
        if($isViewable){
            return $this->hasMany('Product','member_id')->where('is_delete', '=', 0, 'AND')->where('is_draft', '=', 0, 'AND');
        }

        return $this->hasMany('Product', 'member_id');
    }
    
    /**
     * Returns the storename of the member entity
     * @return string
     */
    public function getStoreName()
    {
        $trimmedStorename = trim($this->attributes['store_name']);
        $storename = $this->attributes['store_name'];
        if ( strlen($trimmedStorename) <= 0 || !$trimmedStorename ){ 
            $storename = $this->attributes['username'];
        }

        return $storename;
    }
}

