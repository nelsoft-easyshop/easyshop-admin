<?php

class HomeController extends BaseController
{

	public function index()
	{
	    return View::make('pages.dashboard')->with('username', Auth::user()->username);
	}

	public function getAllUsers()
    {
        $type = array(
            '0' => 0,
            '1' => 3,
            '2' => 4,
        );
        $list_of_loc = LocationLookUp::whereIn('type',$type)->orderBy('location','ASC')->get();
        $data = array();
        foreach($list_of_loc as $r)
        {
            if($r['type'] == 0)
            {
                $data['country_name'] = $r['location'];
                $data['country_id'] = $r['id_location'];
            }
            else if($r['type'] == 3)
            {
                $data['stateregion_lookup'][$r['id_location']] = $r['location'];
            }
            else if($r['type'] == 4)
            {
                $data['city_lookup'][$r['parent_id']][$r['id_location']] = $r['location'];
            }
        }
        $data['json_city'] = json_encode($data['city_lookup'], JSON_FORCE_OBJECT);
        $list = array (
            'list_of_member' => Member::paginate(2),
            'list_of_location' =>$data
        );

		return View::make('pages.userlist')->with($list);
	}
    public function updateUsersAndReturn()
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
            'address' => Input::get('address')
        );
        $member = Member::find(Input::get('id'));
        $member->update($dataMember);
        $address = Address::where('id_member','=',Input::get('id'))->first();
        if($address)
        {
            $address->update($dataAddress);
        }
        else
        {
            $dataAddress['id_member'] = Input::get('id');
            $dataAddress['country'] = 148;
            Address::insert($dataAddress);
        }
        $address = array(
            'city' => $member->Address->city,
            'n_city' => $member->Address->City->location,
            'stateregion' => $member->Address->stateregion,
            'n_stateregion' => $member->Address->region->location,
            'address' => $member->Address->address
        );
        $returnData = array(
            'member' => $member,
            'address' => $address
        );

        return $returnData;
    }
}
