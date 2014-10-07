<?php
use Carbon\Carbon;
use Easyshop\Services\XMLContentGetterService as XMLService;

class ReportsManagerController extends BaseController
{
    
    /**
     * Member Repository
     */
    private $memberRepository;

    /**
     * Member CategoryRepository
     */
    private $categoryRepository; 
    
    /**
     * Member ProductRepository
     */
    private $productRepository;       

    /**
     * Lists of months
     */
    private $listOfMonths;       
    public function __construct()
    {
        $this->memberRepository = App::make('MemberRepository'); 
        $this->categoryRepository = App::make('CategoryRepository'); 
        $this->productRepository = App::make('ProductRepository'); 
        $this->listOfMonths = array("January", "February", "March", "April", "May", "June", "July", "August", "September","October","November","December");       
    }

    /**
     * Render reports console
     * @return View
     */
    public function showReportsConsole()
    {

        $productsPerCategory = $this->categoryRepository->getItemsPerParentCategory($this->categoryRepository->getParentCategories());
        $categories = $this->categoryRepository->getParentCategories();

        foreach ($this->listOfMonths as $key => $value) {
            $signups[] = $this->memberRepository->getMonthlySignUp($key);
            $uploadedProductsPerMonth[] = $this->productRepository->getProductsUploadedPerMonth($key);
        }

        $uploadedProductsSummary = $this->memberRepository->getNumberOfUploadedProductsPerAccount();

        return View::make("pages.reports")
                ->with("membersWithProducts",$uploadedProductsSummary["members"])
                ->with("membersProductCounts",$uploadedProductsSummary["productCount"])
                ->with("numberOfSignUps",$signups)
                ->with("usersWithUploadProducts",$this->memberRepository->getUsersWithOrWithoutUploadedProduct())
                ->with("uploadedItemsPerMonth",$uploadedProductsPerMonth)
                ->with("categoryNames",$productsPerCategory["parentNames"])
                ->with("productCountPerCategory",$productsPerCategory["productCount"])
                ->with("listOfMonths",$this->listOfMonths);
    }


    
}



