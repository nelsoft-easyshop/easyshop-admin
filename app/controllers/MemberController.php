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
        $dataFormatter = $this->locationService;
        $data = $dataFormatter->location($locationLookUpRepository->getByType());

        return View::make('pages.userlist')
            ->with('list_of_member', Member::paginate(100))
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
