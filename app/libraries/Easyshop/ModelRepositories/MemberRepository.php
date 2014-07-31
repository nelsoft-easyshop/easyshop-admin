<?php namespace Easyshop\ModelRepositories;

use Member;

class MemberRepository
{
    public function updateMember($id,$data)
    {
        Member::find($id)->update($data);
    }
    public function getMemberById($id)
    {
        $member = Member::find($id);
        $member->Address;
        $member->Address->City;
        $member->Address->Region;

        return $member;
    }
}

