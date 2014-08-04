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
}

