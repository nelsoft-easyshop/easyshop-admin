<?php
class Member extends Eloquent
{
    protected $table = 'es_member';
    protected $fillable = array('fullname', 'contactno', 'remarks', 'is_promo_valid');
	protected $primaryKey = 'id_member';

    public function address()
    {
        return $this->hasOne('Address', 'id_member');
    }

    public function product($isViewable=false)
    {
        if($isViewable)
        {
            return $this->hasMany('Product','member_id')->where('is_delete', '=', 0, 'AND')->where('is_draft', '=', 0, 'AND');
        }

        return $this->hasMany('Product', 'member_id');
    }
}
