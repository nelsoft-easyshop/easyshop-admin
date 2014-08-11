<?php
class HomeController extends BaseController
{
    public function index()
    {
        return View::make('pages.dashboard')->with('username', Auth::user()->username);
    }

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
            ->with('list_of_member', App::make('MemberRepository')
            ->search($userData,100))->with('list_of_location', $data);
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

    public function showAllItems()
    {
        return View::make('pages.itemlist')
            ->with('list_of_items', App::make('ProductRepository')
            ->getAllViewable(100));
    }

    public function doSearchItem()
    {
        $userData = array(
            'item' => Input::get('item'),
            'category' => Input::get('category'),
            'brand' => Input::get('brand'),
            'condition' => Input::get('condition'),
            'seller' => Input::get('seller'),
            'startdate' => Input::get('startdate'),
            'enddate' => Input::get('enddate')
        );

        return View::make('pages.itemlist')
            ->with('list_of_items', App::make('ProductRepository')
            ->search($userData,100));
    }

    public function transactionRecord()
    {
        $userData = array(
            'startdate' => Input::get('trans_startdate'),
            'enddate' => Input::get('trans_enddate')
        );

        $orderRepository = App::make('OrderRepository');
        $transactionRecord = $orderRepository->getTransactionRecord($userData);

        $excelService = App::make('Easyshop\Services\ExcelService');
        $excelService->transactionRecord('EasyshopRecord', $transactionRecord);
    }
}
