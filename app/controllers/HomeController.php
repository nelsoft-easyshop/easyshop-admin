<?php
class HomeController extends BaseController
{
	public function index()
	{
	    return View::make('pages.dashboard')->with('username', Auth::user()->username);
	}

	public function showAllUsers()
    {
        $type = array(
            '0' => 0,
            '1' => 3,
            '2' => 4
        );
        $listOfLoc = App::make('LocationLookUpRepository');
        $dataFormatter = App::make('Easyshop\Services\DataFormatterService');
        $data = $dataFormatter->location($listOfLoc->getLocationLookUpByType($type));

        return View::make('pages.userlist')->with('list_of_member', Member::paginate(100))->with('list_of_location', $data);
    }
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
        $member = App::make('MemberRepository');
        $member->updateMember(Input::get('id'), $dataMember);
        $address = App::make('AddressRepository');
        $address->doAddress(Input::get('id'), $dataAddress);

        echo json_encode($member->getMemberById(Input::get('id')));
    }
    public function showAllItems()
    {
        return View::make('pages.itemlist')->with('list_of_items',App::make('ProductRepository')->showAllProduct(true)->paginate(100));
    }
}
