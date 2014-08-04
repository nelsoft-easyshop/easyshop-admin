<?php namespace Easyshop\ModelRepositories;

use Member;

class MemberRepository
{
    public function update($id,$data)
    {
        Member::find($id)->update($data);
    }

    public function getById($id)
    {
        $member = Member::find($id);
        $member->Address;
        $member->Address->City;
        $member->Address->Region;

        return $member;
    }

    public function search($userData)
    {
        $member = Member::join('es_product', 'es_member.id_member', '=', 'es_product.member_id')
            ->where('es_product.is_delete', '=', 0)->where('es_product.is_draft', '=', 0, 'AND');
        if($userData['fullname']){
            $member->where('es_member.fullname', 'LIKE', '%' . $userData['fullname'] . '%');
        }
        if($userData['username']){
            $member->where('es_member.username', 'LIKE', '%' . $userData['username'] . '%');
        }
        if($userData['contactno']){
            $member->where('es_member.contactno', 'LIKE', '%' . $userData['contactno'] . '%');
        }
        if($userData['email']){
            $member->where('es_member.email', 'LIKE', '%' . $userData['email'] . '%');
        }
        if(($userData['startdate']) && ($userData['enddate'])){
            $member->where('es_member.datecreated', '>=', str_replace('/', '-', $userData['startdate']) . ' 00:00:00' )->where('es_member.datecreated', '<=', str_replace('/', '-', $userData['enddate']) . ' 12:59:59', 'AND');
        }

        return $member->paginate(100);
    }
}
