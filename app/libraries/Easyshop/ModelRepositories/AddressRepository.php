<?php namespace Easyshop\ModelRepositories;

use Address;

class AddressRepository extends AbstractRepository
{
    public function update($id, $data)
    {
        $address = new Address();
        $hasResult = $address->where('id_member', '=', $id)->first();
        if($hasResult){
            $hasResult->update($data);
        }else{
            $data['id_member'] = $id;
            $this->insert($data);
        }
    }

    public function insert($data)
    {
        $address = new Address();
        $address->insert($data);
    }

    public function getByMemberId($id)
    {
        return Address::where('id_member', '=', $id)->first();
    }
}
