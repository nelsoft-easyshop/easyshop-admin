<?php

use Illuminate\Support\MessageBag;
use Easyshop\Services\Validation\Laravel\RegistrationValidator;

class AccountController extends BaseController
{

    /** 
     *  Render Login View
     *
     */
    public function showLogin()
    {
        return View::make('pages.login');
    }
    
    /**
     * Perform user authentication
     *
     */
    public function doLogin()
    {
        $rules = array(
            'username' => 'required',
            'password' => 'required', 
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            Input::flash();
            return View::make('pages.login')
                ->withErrors($validator)
                ->withInput(Input::except('password')); 
        }

        // create our user data for the authentication
        $userdata = array(
            'username'  => Input::get('username'),
            'password'  => Input::get('password'),
            'is_active' => '1'
        );


        if (Auth::attempt($userdata)) {
            return Redirect::to('/');  
        }

        $errors = new MessageBag(['login_error' => ['Username and/or password is invalid.']]); 
            Input::flash();
            return View::make('pages.login')
            ->withErrors($errors)
            ->withInput(Input::except('password')); 
    }

    /**
     * Logout user
     *
     */
    public function doLogout()
    {
        Auth::logout();
        return Redirect::to('/');  
    }

    /**
     * Retrieves account details
     * @return JSON
     */
    public function getAdminAccount()
    {
        $adminRepo = App::make('AdminMemberRepository');
        $adminObj = $adminRepo->getAdminMemberById(Input::get("userId"));
        $html =  View::make('partials.editadminaccount')
                    ->with("adminObj",$adminObj)
                    ->render();  

        return Response::json(['html' => $html]);
    }

    /**
     * Resets password
     * @return JSON
     */
    public function resetPassword()
    {
        $adminRepo = App::make('AdminMemberRepository');
        $result = $adminRepo->resetPassword(Input::get("id"), Input::get("password"));
        return Response::json(['result' => $result]);   
    }

    /**
     *  Render the registration page
     *
     *  @return View
     */
    public function showRegistration()
    {
        $adminEntity = App::make('AdminMemberRepository');
        foreach($adminEntity->getAllAdminUsers() as $users)
        {
            $allUsers[] = $users;
            $specificRoles[] = $adminEntity->getAdminRoleById($users->id_admin_member);
        }

        return View::make('pages.registration')
                ->with("users",$adminEntity->getAllAdminUsers())
                ->with("index",1)
                ->with("roles",$adminEntity->getAllAdminRoles())
                ->with("specificRoles",$specificRoles);         
    }

    /**
     * Perform user registration
     *
     */
    public function doRegister()
    {
        $registerRepository = App::make('RegisterAdminRepository');
        $validator = new RegistrationValidator( App::make('validator') );

        if($validator->with(Input::get())->passes()){

            $registerRepository->registerAdmin(Input::get('username'),
                                            Hash::make(Input::get('password')), 
                                            Input::get('fullname'));

            if($registerRepository) {
                return Response::json("success");
            }
        }
        else {
            Input::flash();
            return Response::json(array('errors' => $validator->errors()));
        }
    }
    
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
            $specificRoles[] = $adminEntity->getAdminRoleById($users->id_admin_member);

        }

        return View::make('pages.adminusers')
                ->with("users",$adminEntity->getAllAdminUsers())
                ->with("index",1)
                ->with("roles",$adminEntity->getAllAdminRoles())
                ->with("specificRoles",$specificRoles);    
    }

    /**
     *  PUT method that updates the role of a particular administrator
     *
     *  @return JSON
     */ 
    public function updateAdministratorRole()
    {
        $adminEntity = App::make('AdminMemberRepository');
        $isSuccessful = $adminEntity->updateAdminRole(Input::get('adminid'),
                                                      Input::get('roleid'));

        return Response::json(array($isSuccessful)); 

    }

    /**
     *  PUT method that updates the activation of administrator
     *
     *  @return JSON
     */ 
    public function updateAdministratorActivation()
    {
        $adminEntity = App::make('AdminMemberRepository');
        $isSuccessful = $adminEntity->updateAdminActivation(Input::get('adminid'),
                                                      Input::get('activation'));

        return Response::json(array($isSuccessful)); 

    }    

    /** 
     *  Render prohibited page
     *
     */
    public function prohibited()
    {
        return View::make('pages.prohibited');
    }    


}
