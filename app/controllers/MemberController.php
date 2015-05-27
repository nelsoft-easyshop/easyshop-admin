<?php

use Easyshop\Services\LocationService;
use Easyshop\ModelRepositories\LocationLookUpRepository as LocationLookUpRepository;
use Easyshop\ModelRepositories\BanTypeRepository as BanTypeRepository;
use Easyshop\ModelRepositories\MemberRepository as MemberRepository;

class MemberController extends BaseController
{

    /**
     * Location Service
     *
     * @var EasyShop\Service\LocationService
     */
    private $locationService;

    /**
     * Location Look-up Repository
     *
     * @var EasyShop\ModelRepository\LocationLookUpRepository
     */
    private $locationLookUpRepository;

    /**
     * BanType Repository
     *
     * @var EasyShop\ModelRepository\BanTypeRepository
     */
    private $banTypeRepository;

    /**
     * Member Repository
     *
     * @var EasyShop\ModelRepository\MemberRepository
     */
    private $memberRepository;

    /**
     * Member Service
     *
     * @var EasyShop\Service\MemberService
     */
    private $memberService;

    public function __construct(LocationService $locationService,
                                LocationLookUpRepository $locationLookUpRepository,
                                BanTypeRepository $banTypeRepository,
                                MemberRepository $memberRepository)
    {
        $this->locationService = $locationService;
        $this->locationLookUpRepository = $locationLookUpRepository;
        $this->banTypeRepository = $banTypeRepository;
        $this->memberRepository = $memberRepository;
        $this->memberService = App::make('MemberService');;
    }

    /**
     * Retrieves the user list
     *
     * @return View
     */
    public function showAllUsers()
    {
        $listOfLocation =  $this->locationService->location($this->locationLookUpRepository->getByType());
        $listOfBanType = $this->banTypeRepository->getByType();

        return View::make('pages.userlist')
                   ->with('member_count', $this->memberRepository->getUsersCount())
                   ->with('list_of_member', Member::paginate(100))
                   ->with('list_of_location', $listOfLocation)
                   ->with('list_of_ban_type', $listOfBanType);
    }

    /**
     * Search user and filtering
     *
     * @return View
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
        
        $hasSearchString = false;
        foreach($userData as $searchString){
            if(empty($searchString) === false){
                $hasSearchString = true;
                break;
            }
        }

        if($hasSearchString === false){
            return Redirect::to('/users');
        }

        $locationService = $this->locationService;
        $listOfLocation = $locationService->location($this->locationLookUpRepository->getByType());
        $listOfBanType = $this->banTypeRepository->getByType();
        return View::make('pages.userlist')
                   ->with('member_count', $this->memberRepository->getUsersCount())        
                   ->with('list_of_member', $this->memberRepository->search($userData, 100))
                   ->with('list_of_location', $listOfLocation)
                   ->with('list_of_ban_type', $listOfBanType);
    }

    /**
     * Update userdetails
     *
     * @return JSON
     */
    public function ajaxUpdateUsers()
    {
        $dataMember = [
            'fullname' => Input::get('fullname'),
            'contactno' => Input::get('contact'),
            'remarks' => Input::get('remarks'),
            'is_promo_valid' => Input::get('is_promo_valid'),
            'is_banned' => (int) Input::get('banType') ? true : false,
            'ban_type' => (int) Input::get('banType')
        ];
        $dataAddress = [
            'city' => Input::get('city'),
            'stateregion' => Input::get('stateregion'),
            'address' => Input::get('address'),
            'country' => 148
        ];
        $member = $this->memberRepository->getById(Input::get('id'));
        $memberUpdate = $this->memberService->updateMember($member, $dataMember);
        if (intval($dataAddress['stateregion']) !== 0 && $memberUpdate['isSuccess']) {
            $addressRepository = App::make('AddressRepository');
            $addressRepository->update(Input::get('id'), $dataAddress);
            $member->Address->City;
            $member->Address->Region;
        }

        echo json_encode($memberUpdate);
    }
}
