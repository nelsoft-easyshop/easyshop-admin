<?php namespace Easyshop\ModelRepositories;

use AdminMember, AdminRoles;

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

    /**
     * Get order by id
     *
     * @return Entity
     */
    public function getAllAdminUsers()
    {
        return AdminMember::all();
    } 

    /**
     * Get all of admin roles
     *
     * @return Entity
     */
    public function getAllAdminRoles()
    {
        return AdminRoles::all();
    }    

    /**
     *  Get role of a particular administrator
     *
     *  @param int $roleId
     *  @return array
     */
    public function getAdminRoleById($roleId,$adminId)
    {
         $query = AdminMember::leftJoin('es_admin_member_role', 'es_admin_member.role_id', '=', 'es_admin_member_role.id_role')
         ->where('es_admin_member.role_id','=', $roleId)
         ->where('es_admin_member.id_admin_member','=', $adminId)
         ->get();
         return $query;
    }  

    /**
     *  Update the role of a particular administrator
     *
     *  @param int $roleId
     *  @param int $adminId     
     *  @return array
     */
    public function updateAdminRole($adminId, $roleId)
    {            
        $adminEntity = AdminMember::find($adminId);
        $adminEntity->role_id = $roleId;
        $isSuccessful = $adminEntity->save();        
        return $isSuccessful;        
    }

    /**
     * Get the role_id of the passed adminId
     *
     * @param interger $adminId
     * @return Entity
     */
    public function getAdminRoleId($adminId)
    {
        return AdminMember::find($adminId)->pluck('role_id');
    }   

    
}

