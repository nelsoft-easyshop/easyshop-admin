<?php namespace Easyshop\ModelRepositories;

use AdminMember, AdminRoles;
use Illuminate\Support\Facades\DB;

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
        return AdminMember::find($id);
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
    public function getAdminRoleById($adminId)
    {
         $query = AdminMember::leftJoin('es_admin_member_role', 'es_admin_member.role_id', '=', 'es_admin_member_role.id_role')
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
     *  Update the account activation administrator
     *
     *  @param int $adminId
     *  @param int $activation     
     *  @return array
     */
    public function updateAdminActivation($adminId, $activation)
    {            
        $adminEntity = AdminMember::find($adminId);
        $adminEntity->is_active = $activation;
        $isSuccessful = $adminEntity->save();        
        return $isSuccessful;        
    }    

    /**
     *  Resets password
     *
     *  @param int $adminId
     *  @param string $password
     *  @return bool
     */
    public function resetPassword($adminId, $password)
    {            
        $adminEntity = AdminMember::find($adminId);
        $adminEntity->password = \Hash::make($password);
        return $adminEntity->save();        
    }    

    /**
     * Get the role_id of the passed adminId
     *
     * @param interger $adminId
     * @return Entity
     */
    public function getAdminRoleId($adminId)
    {
        return AdminMember::find($adminId)->role_id;
    }   
    /**
     * Returns the role name retrieved from AdminRoles model
     *
     * @param string $roleName
     * @return Entity
     */
    public function getRoleNames($roleName)
    {
        if($roleName == "CONTENT") {
            return AdminRoles::CONTENT;
        }
        else if($roleName == "CSR") {
            return AdminRoles::CSR;
        }
        else if($roleName == "MARKETING") {
            return AdminRoles::MARKETING;
        }
        else if($roleName == "SUPER-USER") {
            return AdminRoles::SUPER_USER;
        }
        else if($roleName == "GUEST") {
            return AdminRoles::GUEST;
        }  
    }

    
}

