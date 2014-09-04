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
     * Determines the accessible pages of the current administrator
     *
     * @param string $currentUrl
     *
     * @return bool
     */    
    public function getPrivilege($currentUrl)
    {
        $this->adminMemberRepo = new AdminMemberRepository;
        $url = str_replace(\URL::to('/'),"", $currentUrl);
        $currentAdminId = \Auth::id();
    
        $roleOfCurrentAdmin = $this->adminMemberRepo->getAdminRoleById($currentAdminId);

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
        //change the values of $pages array for the accessbile pages per admin role

        $this->adminMemberRepo = new AdminMemberRepository;

        if($currentRole == $this->adminMemberRepo->getRoleNames("CONTENT")) {
            $pages = array("cms","users");
        }
        else if($currentRole == $this->adminMemberRepo->getRoleNames("CSR")) {
            $pages = array("cms/home","cms/feeds");
        }
        else if($currentRole == $this->adminMemberRepo->getRoleNames("MARKETING")) {
            $pages = array("cms/home","cms/feeds");
        }
        else if($currentRole == $this->adminMemberRepo->getRoleNames("SUPER-USER")) {
            $pages = array("cms/home","cms/feeds");
        }
        else if($currentRole == $this->adminMemberRepo->getRoleNames("SUPER-USER")) {
            $pages = array("cms/home","cms/feeds");
        }     
        else if($currentRole == $this->adminMemberRepo->getRoleNames("GUEST")) {
            $pages = array("cms/home","cms/feeds");
        }                
        return $pages;              
    }



}
