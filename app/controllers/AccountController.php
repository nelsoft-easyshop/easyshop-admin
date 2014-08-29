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
            'username' 	=> Input::get('username'),
            'password' 	=> Input::get('password'),
        );


        if (Auth::attempt($userdata)){
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
     *  Render the registration page
     *
     *  @return View
     */
    public function showRegistration()
    {
        return View::make('pages.registration');
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
                                            Crypt::encrypt(Input::get('password')), 
                                            Input::get('fullname'));

            if($registerRepository) {
                return Response::json("success");
            }
        }
        else {
            return Response::json(array('errors' => $validator->errors()));
        }
    }


}
