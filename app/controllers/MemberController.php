<?php
use Easyshop\Services\LocationService;
class MemberController extends BaseController
{
    private $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function showAllUsers()
    {
        $locationLookUpRepository = App::make('LocationLookUpRepository');
        $MemberRepository = App::make('MemberRepository');
        $locationService = $this->locationService;
        $data = $locationService->location($locationLookUpRepository->getByType());
        return View::make('pages.userlist')
            ->with('member_count', $MemberRepository->getUsersCount())
            ->with('list_of_member', Member::paginate(100))
            ->with('list_of_location', $data);


    }

    public function search()
    {
        $userData = array(
            'fullname' => Input::get('fullname'),
            'store_name' => Input::get('store_name'),
            'contactno' => Input::get('number'),
            'email' => Input::get('email'),
            'startdate' => Input::get('startdate'),
            'enddate' => Input::get('enddate')
        );
        $locationLookUpRepository = App::make('LocationLookUpRepository');
        $locationService = $this->locationService;
        $data = $locationService->location($locationLookUpRepository->getByType());
        $MemberRepository = App::make('MemberRepository');
        return View::make('pages.userlist')
            ->with('member_count', $MemberRepository->getUsersCount())        
            ->with('list_of_member', App::make('MemberRepository')->search($userData, 100))
            ->with('list_of_location', $data);
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
        $memberRepository = App::make('MemberRepository');
        $memberRepository->update(
            $memberRepository->getById(Input::get('id')),
            $dataMember
        );
        $member = $memberRepository->getById(Input::get('id'));
        if(intval($dataAddress['stateregion']) != 0){
            $addressRepository = App::make('AddressRepository');
            $addressRepository->update(Input::get('id'), $dataAddress);
            $member->Address->City;
            $member->Address->Region;
        }

        echo json_encode($member);
    }
}
