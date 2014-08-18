<?php namespace Easyshop\ModelRepositories;

use AdminMember;

class AdminMemberRepository
{
    /**
    * Get order by id
    *
    * @param string $slug
    * @return Entity
    */
    public function getAdminMemberById($id)
    {
        return AdminMember::find($id)->pluck('password');
    }
    
}

