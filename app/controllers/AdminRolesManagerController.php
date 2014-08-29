<?php 



class AdminRolesManagerController extends BaseController
{
    
    /**
     *  Get Administrator Users
     *  @return View
     */    
    public function showAdminLists()
    {
        $adminEntity = App::make('AdminMemberRepository');
        foreach($adminEntity->getAllAdminUsers() as $users)
        {
            $allUsers[] = $users;
            $specificRoles[] = $adminEntity->getAdminRoleById($users->role_id);

        }
        return View::make("pages.adminusers")
                ->with("users",$adminEntity->getAllAdminUsers())
                ->with("index",1)
                ->with("roles",$adminEntity->getAllAdminRoles())
                ->with("specificRoles",$specificRoles);
    }
    /**
     *  Updates the role of a particular administrator
     *
     *  @return JSON
     */ 
    public function updateAdministratorRole()
    {
        $adminEntity = App::make('AdminMemberRepository');
        $isSuccessful = $adminEntity->updateAdminRole(Input::get('adminid'),
                                                      Input::get('roleid'));
        if($isSuccessful) {
            return Response::json("success");
        }
        else {
            return Response::json("error");            
        } 


    }

}
