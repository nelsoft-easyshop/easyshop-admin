<?php
class HomeController extends BaseController
{

    /**
     * Render admin dashboard page
     *
     */
    public function index()
    {
        return View::make('pages.dashboard')->with('username', Auth::user()->username);        
    }
    
    /**
     * Render page for generating user list
     *
     */
    public function showAllUsers()
    {
        $listOfLoc = App::make('LocationLookUpRepository');
        $dataFormatter = App::make('Easyshop\Services\DataFormatterService');
        $data = $dataFormatter->location($listOfLoc->getLocationByType());

        return View::make('pages.userlist')->with('list_of_member', Member::paginate(100))->with('list_of_location', $data);
    }
    
    /**
     * Update a member's information
     *
     */
    public function ajaxUpdateUsers()
    {
        $dataMember = array(
            'fullname' => Input::get('fullname'),
            'contactno' => Input::get('contact'),
            'remarks' => Input::get('remarks'),
            'is_promo_valid' => Input::get('is_promo_valid')
        );
        $dataAddress = array(
            'city' => Input::get('city'),
            'stateregion' => Input::get('stateregion'),
            'address' => Input::get('address'),
            'country' => 148
        );
        
        $memberRepository = App::make('MemberRepository');
        $addressRepository = App::make('AddressRepository');
        
        $memberRepository->update(Input::get('id'), $dataMember);
        $addressRepository->update(Input::get('id'), $dataAddress);
                
        echo json_encode($memberRepository->getMemberById(Input::get('id')));
    }
    

    
}
