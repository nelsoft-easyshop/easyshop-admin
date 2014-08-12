<?php
class MemberController extends BaseController
{

    public function showAllUsers()
    {
        $locationLookUpRepository = App::make('LocationLookUpRepository');
        $dataFormatter = App::make('Easyshop\Services\DataFormatterService');
        $data = $dataFormatter->location($locationLookUpRepository->getByType());

        return View::make('pages.userlist')
            ->with('list_of_member', Member::paginate(100))
            ->with('list_of_location', $data);
    }

    public function doSearchUser()
    {
        $userData = array(
            'fullname' => Input::get('fullname'),
            'username' => Input::get('username'),
            'contactno' => Input::get('number'),
            'email' => Input::get('email'),
            'startdate' => Input::get('startdate'),
            'enddate' => Input::get('enddate')
        );
        $locationLookUpRepository = App::make('LocationLookUpRepository');
        $dataFormatter = App::make('Easyshop\Services\DataFormatterService');
        $data = $dataFormatter->location($locationLookUpRepository->getByType());

        return View::make('pages.userlist')
            ->with('list_of_member', App::make('MemberRepository')->search($userData))
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
        $memberRepository->update(Input::get('id'), $dataMember);
        $addressRepository = App::make('AddressRepository');
        $addressRepository->update(Input::get('id'), $dataAddress);

        echo json_encode($memberRepository->getById(Input::get('id')));
    }
}
