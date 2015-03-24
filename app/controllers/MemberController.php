<?php
use Easyshop\Services\LocationService;
use Easyshop\ModelRepositories\LocationLookUpRepository as LocationLookUpRepository;
use Easyshop\ModelRepositories\BanTypeRepository as BanTypeRepository;
use Easyshop\ModelRepositories\MemberRepository as MemberRepository;
class MemberController extends BaseController
{
    private $locationService;

    public function __construct(LocationService $locationService,
                                LocationLookUpRepository $locationLookUpRepository,
                                BanTypeRepository $banTypeRepository,
                                MemberRepository $MemberRepository)
    {
        $this->locationService = $locationService;
        $this->locationLookUpRepository = $locationLookUpRepository;
        $this->banTypeRepository = $banTypeRepository;
        $this->MemberRepository = $MemberRepository;
    }

    /**
     * Retrieves the user list
     * @return mixed
     */
    public function showAllUsers()
    {
        $listOfLocation =  $this->locationService->location($this->locationLookUpRepository->getByType());
        $listOfBanType = $this->banTypeRepository->getByType();

        return View::make('pages.userlist')
                    ->with('member_count', $this->MemberRepository->getUsersCount())
                    ->with('list_of_member', Member::paginate(100))
                    ->with('list_of_location', $listOfLocation)
                    ->with('list_of_ban_type', $listOfBanType);
    }

    /**
     * Search user and filtering
     * @return mixed
     */
    public function search()
    {
        $userData = [
            'fullname' => Input::get('fullname'),
            'store_name' => Input::get('store_name'),
            'contactno' => Input::get('number'),
            'email' => Input::get('email'),
            'startdate' => Input::get('startdate'),
            'enddate' => Input::get('enddate'),
            'username' => Input::get('username')
        ];
        $locationLookUpRepository = App::make('LocationLookUpRepository');
        $locationService = $this->locationService;
        $listOfLocation = $locationService->location($locationLookUpRepository->getByType());
        $listOfBanType = $this->banTypeRepository->getByType();
        $MemberRepository = App::make('MemberRepository');
        return View::make('pages.userlist')
            ->with('member_count', $MemberRepository->getUsersCount())        
            ->with('list_of_member', App::make('MemberRepository')->search($userData, 100))
            ->with('list_of_location', $listOfLocation)
            ->with('list_of_ban_type', $listOfBanType);
    }

    public function ajaxUpdateUsers()
    {
        $dataMember = array(
            'fullname' => Input::get('fullname'),
            'contactno' => Input::get('contact'),
            'remarks' => Input::get('remarks'),
            'is_promo_valid' => Input::get('is_promo_valid'),
            'is_banned' => (int) Input::get('banType') ? 1 : 0,
            'ban_type' => (int) Input::get('banType')
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
