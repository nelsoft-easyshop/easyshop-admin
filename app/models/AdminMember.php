<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class AdminMember extends Eloquent implements UserInterface, RemindableInterface 
{

    use UserTrait, RemindableTrait;

   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'es_admin_member';

   /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
    protected $hidden = array('password', 'remember_token');

   /**
    * The primary key of the table
    *
    */

    protected $primaryKey = 'id_admin_member';

}
