<?php

namespace Easyshop\Services;

use Easyshop\ModelRepositories\MemberRepository as MemberRepository;

class MemberManager
{
    /**
     * Member Repository
     * @var EasyShop\ModelRepository\MemberRepository
     */
    private $memberRepository;

    /**
     * Member Update Validator
     *
     * @var Easyshop\Services\Validation\Laravel\MemberUpdateValidator
     */
    private $memberUpdateValidator;

    /**
     * Constructor
     */
    public function __construct(MemberRepository $memberRepository, $memberUpdateValidator)
    {
        $this->memberRepository = $memberRepository;
        $this->memberUpdateValidator = $memberUpdateValidator;
    }

    /**
     * Update member data
     * @param  object $member
     * @param  array  $memberData
     * @return array
     */
    public function updateMember($member, $memberData)
    {
        $rules = $this->memberUpdateValidator->getRules();
        $messages = $this->memberUpdateValidator->getMessages();
        $this->memberUpdateValidator->setRules($rules);
        $this->memberUpdateValidator->setMessages($messages);
        $updatedMember = false;
        if($this->memberUpdateValidator->with($memberData)->passes()){
            $updatedMember = $this->memberRepository->update($member, $memberData);
        }

        return [
            'isSuccess' => $updatedMember,
            'errors' => $this->memberUpdateValidator->errors(),
            'member' => $member,
        ];
    }
}
