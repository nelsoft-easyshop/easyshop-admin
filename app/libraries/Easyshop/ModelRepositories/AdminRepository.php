<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
use AdminMember;

class AdminRepository
{
   /**
    * Get order by id
    *
    * @param string $slug
    * @return Entity
    */
    public function getAdmin($id)
    {
        return AdminMember::find($id)->pluck('password');
    }
    
}

