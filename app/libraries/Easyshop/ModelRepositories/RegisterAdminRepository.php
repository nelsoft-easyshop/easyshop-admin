<?php namespace Easyshop\ModelRepositories;

use AdminMember;

class RegisterAdminRepository
{

             
    /**
     * Perform the insertion of data under es_admin_member table
     *
     * @param string $username
     * @param string $password
     * @param string $fullname
     *
     * @return bool
     */
    public function registerAdmin($username, $password, $fullname)
    {
        $adminMember = new AdminMember;
       
        $adminMember->username = $username;
        $adminMember->password = $password;
        $adminMember->fullname = $fullname;
        $isSuccessful = $adminMember->save();
        
        return $isSuccessful;
    }
    
}



