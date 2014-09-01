<?php namespace Easyshop\Services;

use Easyshop\ModelRepositories\AdminMemberRepository as AdminMemberRepository;


class AdminMemberManagerService
{
    
    /**
     * AdminMemberRepository Repository
     *
     * @var adminMemberRepo
     */
    private $adminMemberRepo;

    /**
     * Inject dependecy
     *
     */
    public function __construct(AdminMemberRepository $adminMemberRepo)
    {
        $this->adminMemberRepo = $adminMemberRepo;
    }

    /**
     * Determines the accessible pages of the current administrator
     *
     * @param string $currentUrl
     *
     * @return bool
     */    
    public function GetPrivilege($currentUrl)
    {
        $url = str_replace(\URL::to('/'),"", $currentUrl);

        $roleId = $this->adminMemberRepo->getAdminRoleId(\Auth::id());
        $roleOfCurrentAdmin = $this->adminMemberRepo->getAdminRoleById($roleId, \Auth::id());

        foreach($roleOfCurrentAdmin as $role)
        {
            $currentRole = $role->role_name;
        }

        $pages = $this->getPages($currentRole);
        if(in_array($url, $pages)) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Returns the set of accessible pages of the passed role name
     *
     * @param string $currentRole
     *
     * @return array
     */    
    public function getPages($currentRole) {
        if($currentRole == "CONTENT") {
            $pages = array("/test","/cms/feeds");
        }
        else if($currentRole == "CSR") {
            $pages = array("/cms/home","/cms/feeds");
        }
        else if($currentRole == "MARKETING") {
            $pages = array("/cms/home","/cms/feeds");
        }
        else if($currentRole == "SUPER-USER") {
            $pages = array("/cms/home","/cms/feeds");
        }
        return $pages;              
    }

}
