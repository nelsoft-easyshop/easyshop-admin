<?php

class AdminRoles extends Eloquent 
{
    const CONTENT = "CONTENT";
    const CSR = "CSR";
    const MARKETING = "MARKETING";
    const GUEST = "GUEST";
    const SUPER_USER = "SUPER-USER";


   /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'es_admin_member_role';

   /**
    * The primary key of the table
    *
    */
    protected $primaryKey = 'id_role';

  

}
