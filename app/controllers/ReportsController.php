<?php
use Carbon\Carbon;
use Easyshop\Services\XMLContentGetterService as XMLService;

class ReportsController extends BaseController
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
        $productsPerCategory = $this->categoryRepository->getProductCountPerParentCategory($this->categoryRepository->getParentCategories());
        $year =  Carbon::parse( \Config::get('transaction.startOfOperation'))->year;
        while($year < Carbon::now()->addYears(1)->year) {
            $yearsArr[] = $year;
            $signupsArr[] = $this->memberRepository->getMonthlySignUp($this->listOfMonths, $year);
            $uploadedProductsPerMonth[] = $this->productRepository->getProductsUploadedPerMonth($this->listOfMonths, $year);
            $year++;
        }

        $uploadedProductsSummary = $this->memberRepository->getNumberOfUploadedProductsPerAccount();

        return View::make("pages.reports")
                ->with("membersWithProducts",$uploadedProductsSummary["members"])
                ->with("membersProductCounts",$uploadedProductsSummary["productCount"])
                ->with("numberOfSignUps",$signupsArr)
                ->with("yearsOfOperation",$yearsArr)
                ->with("usersWithUploadProducts",$this->memberRepository->getNumberOfUsersWithUploadedProduct())
                ->with("uploadedItemsPerMonth",$uploadedProductsPerMonth)
                ->with("categoryNames",$productsPerCategory["parentNames"])
                ->with("productCountPerCategory",$productsPerCategory["productCount"])
                ->with("listOfMonths",$this->listOfMonths);
    }


    
}



