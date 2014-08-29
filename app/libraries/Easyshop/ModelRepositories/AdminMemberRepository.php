<?php namespace Easyshop\ModelRepositories;

use Illuminate\Support\Facades\DB;
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
    public function getAdminRoleById($roleId)
    {
         $query = DB::table('es_admin_member')
         ->leftJoin('es_admin_member_role', 'es_admin_member.role_id', '=', 'es_admin_member_role.id_role')
         ->where('es_admin_member.role_id','=', $roleId)
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
    
}

