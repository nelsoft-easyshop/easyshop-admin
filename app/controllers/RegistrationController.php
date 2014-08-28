<?php 


class RegistrationController extends BaseController 
{

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
        $rules = array(
            'username' => 'required|unique:es_admin_member,username', 
            'password' => 'required|min:8|alpha_num', 
            'fullname' => 'required', 
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            Input::flash();
            return View::make('pages.registration')
                ->withErrors($validator);
        }
        else {

            $registerRepository->registerAdmin(Input::get('username'),
                                            Crypt::encrypt(Input::get('password')), 
                                            Input::get('fullname'));

            if($registerRepository) {
                Input::flash();
                return View::make('pages.registration')
                    ->with('success','success!');
            }
        }
    }

}    