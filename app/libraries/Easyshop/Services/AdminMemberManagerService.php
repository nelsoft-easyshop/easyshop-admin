<?php namespace Easyshop\Services;

use Easyshop\ModelRepositories\AdminMemberRepository as AdminMemberRepository;
use AdminRoles as AdminRoles;

class AdminMemberManagerService
{
    
    /**
     * AdminMemberRepository Repository
     *
     * @var Easyshop\ModelRepositories\AdminMemberRepository
     */
    private $adminMemberRepo;
    
    
    /**
     * URL white list
     *
     * @var string[]
     */
    private $urlWhiteList = [];
    
    public function __construct(AdminMemberRepository $adminMemberRepository)
    {
        $this->adminMemberRepo = $adminMemberRepository;
        $this->urlWhiteList = \Config::get('easyshop/role-route-whitelist');
    }

    /**
     * Determines the accessible pages of the current administrator
     *
     * @param string $currentUrl
     *
     * @return bool
     */    
    public function getPrivilege($currentUrl)
    {
        $url = str_replace(\URL::to('/'),"", $currentUrl);
        $currentAdminId = \Auth::id();

        $roleOfCurrentAdmin = $this->adminMemberRepo->getAdminRoleById($currentAdminId);
        $currentRole = $roleOfCurrentAdmin->role_name;

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
    public function getPages($currentRole) 
    {
        /**
         * $pages = array("first_url_segment_of_accessible_page_of_a_particular_role")
         * "" and "prohibited" pages that must be accessble by all admin roles
         */      
         
        $pages = [];
        if($currentRole === AdminRoles::CONTENT ) {
            $pages = array_merge($pages, $this->urlWhiteList['contentManagement']);
        }
        else if($currentRole == AdminRoles::CSR ) {
            $pages = array_merge($pages, $this->urlWhiteList['transactionManagement']);
            $pages = array_merge($pages, $this->urlWhiteList['dataManagement']);
        }
        else if($currentRole == AdminRoles::MARKETING ) {
            $pages = array_merge($pages, $this->urlWhiteList['transactionManagement']);
            $pages = array_merge($pages, $this->urlWhiteList['dataManagement']);
            $pages = array_merge($pages, $this->urlWhiteList['contentManagement']);
        }
        else if($currentRole == AdminRoles::SUPER_USER ) {
            $pages = array_merge($pages, $this->urlWhiteList['transactionManagement']);
            $pages = array_merge($pages, $this->urlWhiteList['dataManagement']);
            $pages = array_merge($pages, $this->urlWhiteList['contentManagement']);
            $pages = array_merge($pages, $this->urlWhiteList['accountManagement']);
        }   
    
        $pages = array_merge($pages, ["", "prohibited"]);
        return $pages;              
    }



}
