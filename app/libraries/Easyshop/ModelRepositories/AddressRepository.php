<?php namespace Easyshop\ModelRepositories;

use Address;

class AddressRepository
{
    public function doAddress($id,$data)
    {
        $address = new Address();
        $has_result = $address->where('id_member', '=', $id)->first();
        if($has_result){
            $has_result->update($data);
        }else{
            $data['id_member'] = $id;
            $address->insert($data);
        }
    }
    public function getAddressByMemberId($id)
    {
        return Address::where('id_member', '=', $id)->first();
    }
}
