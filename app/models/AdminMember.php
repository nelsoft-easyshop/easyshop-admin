<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class AdminMember extends Eloquent implements UserInterface, RemindableInterface
{
    use UserTrait, RemindableTrait;
    protected $table = 'es_admin_member';
    protected $hidden = array('password', 'remember_token');
    public $timestamps = false;

   /**
    * The primary key of the table
    *
    */
    protected $primaryKey = 'id_admin_member';
}
