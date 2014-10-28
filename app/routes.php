<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::when('*', 'csrf', array('post', 'put', 'delete'));
#LOGIN
Route::get('login', array('uses' => 'AccountController@showLogin'));
Route::post('login', array('uses' => 'AccountController@doLogin'));

#LOGOUT
Route::get('logout', array('uses' => 'AccountController@doLogout'));


Route::group(array('before' => 'auth'), function(){
    Route::get('/', array('uses' => 'HomeController@index'));
    Route::get('users', array('uses' => 'MemberController@showAllUsers'));
    Route::post('users', array('uses' => 'MemberController@search'));
    Route::put('user', array('uses' => 'MemberController@ajaxUpdateUsers'));

    Route::get('cms/home', array('uses' => 'HomeContentManagerController@getHomeContent'));
    Route::get('home', array('uses' => 'NewHomeContentManagerController@getHomeContent'));
    Route::get('getSlideSection/{index}', array('uses' => 'NewHomeContentManagerController@getSlideSection'));
    Route::get('getSubCategoryNavigation/{index}', array('uses' => 'NewHomeContentManagerController@getSubCategoryNavigation'));
    Route::get('getBrandsSection', array('uses' => 'NewHomeContentManagerController@getBrandsSection'));
    Route::get('getCategoriesPanel', array('uses' => 'NewHomeContentManagerController@getAllCategories'));
    Route::get('getNewArrivals', array('uses' => 'NewHomeContentManagerController@getNewArrivals'));
    Route::get('getTopProducts', array('uses' => 'NewHomeContentManagerController@getTopProducts'));
    Route::get('getTopSellers', array('uses' => 'NewHomeContentManagerController@getTopSellers'));
    Route::get('getAllSliders', array('uses' => 'NewHomeContentManagerController@getAllSliders'));
    Route::get('getProductPanel', array('uses' => 'NewHomeContentManagerController@getProductPanel'));
    Route::get('getAdsSection', array('uses' => 'NewHomeContentManagerController@getAdSection'));
    Route::get('getOtherCategories', array('uses' => 'NewHomeContentManagerController@getOtherCategories'));
    Route::get('getSubCategoriesSection/{index}', array('uses' => 'NewHomeContentManagerController@getSubCategoriesSection'));
    Route::get('getCategoriesProductPanel/{index}', array('uses' => 'NewHomeContentManagerController@getCategoriesProductPanel'));
    Route::get('cms/slides', array('uses' => 'HomeContentManagerController@getMainSlides'));
    Route::get('cms/productslides', array('uses' => 'HomeContentManagerController@getProductSlides'));

    Route::get('cms/feeds', array('uses' => 'FeedsContentManagerController@getContentFiles'));
    Route::get('cms/featuredProduct', array('uses' => 'FeedsContentManagerController@getFeaturedProducts'));
    Route::get('cms/popularItem', array('uses' => 'FeedsContentManagerController@getPopularItems'));
    Route::get('cms/promoItems', array('uses' => 'FeedsContentManagerController@getPromoItems'));
    
    Route::get('mobile', array('uses' => 'MobileContentManagerController@showMobileCms'));
    Route::get('mobileSlides', array('uses' => 'MobileContentManagerController@getMainSlides'));

    Route::get('register', array('uses' => 'AccountController@showRegistration'));
    Route::put('register', array('uses' => 'AccountController@doRegister'));    
    Route::get('managerole', array('uses' => 'AccountController@showAdminLists'));    
    Route::put('adminroles', array('uses' => 'AccountController@updateAdministratorRole'));    
    Route::put('adminactivation', array('uses' => 'AccountController@updateAdministratorActivation'));   
    Route::get('payouts/buyer', array('uses' => 'OrderProductController@getOrderProductsContactBuyer'));   

    Route::get('raffle', array('uses' => 'RaffleManagerController@showRaffle'));    
    Route::post('doRaffle', array('uses' => 'RaffleManagerController@doRaffle'));    
    Route::get('showRaffleList', array('uses' => 'RaffleManagerController@showRaffleList'));    
    Route::post('deleteRaffle', array('uses' => 'RaffleManagerController@deleteRaffle'));  

    Route::get('messages', array('uses' => 'MessageController@showMessages'));    
    Route::post('getmessage', array('uses' => 'MessageController@getConversation'));    
    Route::post('getInbox', array('uses' => 'MessageController@getAllMessages'));    
    Route::post('sendMessage', array('uses' => 'MessageController@sendMessage'));    
    Route::get("refreshConversation/{to_id}/{from_id}", array('uses' => 'MessageController@refreshConversation'));    

    Route::get("productcsv", array('uses' => 'ProductCSVController@showCSVupload'));    
    Route::post("productcsv", array('uses' => 'ProductCSVController@doUpload'));    

    Route::get("reports", array('uses' => 'ReportsController@showReportsConsole'));    

    Route::get('searchkeywords', array('uses' => 'SearchKeyWordsController@showSearchKeyWords'));    
    Route::post('customsearchkeywords', array('uses' => 'SearchKeyWordsController@customSearch'));    

    Route::get('category', array('uses' => 'CategoryController@showAllCategory'));
    Route::post('category', array('uses' => 'CategoryController@doSearchCategory'));
    Route::put('categoryUpdate', array('uses' => 'CategoryController@ajaxUpdateCategory'));
    Route::put('categoryAdd', array('uses' => 'CategoryController@ajaxAddCategory'));

    Route::get('items',array('uses'=>'ProductController@showAllItems'));
    Route::get('items', array('uses' => 'ProductController@doSearchItem'));

    Route::get('pay', array('uses' => 'OrderProductController@getUsersToPay'));
    Route::get('refund', array('uses' => 'OrderProductController@getUsersToRefund'));
    Route::get('orderproduct/pay', array('uses' => 'OrderProductController@getOrderProductsToPay'));
    Route::get('orderproduct/refund', array('uses' => 'OrderProductController@getOrderProductsToRefund'));
    Route::get('orderproduct-detail', array('uses' => 'OrderProductController@getOrderProductDetail'));
    Route::get('orderproduct-payment/pay', array('uses' => 'OrderProductController@getOrderProductPaymentDetailToPay'));
    Route::get('orderproduct-payment/refund', array('uses' => 'OrderProductController@getOrderProductPaymentDetailToRefund'));
    Route::put('orderproduct-status/pay', array('uses' => 'OrderProductController@payOrderProducts'));
    Route::get('orderproduct-download', array('uses' => 'OrderProductController@downloadTransactionRecord'));
    Route::put('orderproduct-status/refund', array('uses' => 'OrderProductController@refundOrderProducts'));
    Route::put('billinginfo', array('uses' => 'BillingInfoController@updateOrderProductPaymentAccount'));
    Route::post('billinginfo', array('uses' => 'BillingInfoController@createOrderProductPaymentAccount'));

    Route::get('transaction', array('uses' => 'OrderController@getAllValidOrders'));
    Route::get('order-detail', array('uses' => 'OrderController@getOrderDetail'));
    Route::put('order-void', array('uses' => 'OrderController@voidOrder'));
    Route::put('order-product-void', array('uses' => 'OrderProductController@voidOrderProduct'));

    Route::get('prohibited', array('uses' => 'AccountController@prohibited'));

    // routes for payout notifs
    Route::get('payout/seller', array('uses' => 'OrderProductController@getSellersTransactions'));
    Route::get('payout/seller/view-transactions', array('uses' => 'OrderProductController@getSellerExistingTransaction'));
    Route::get('payout/seller/view-transactions-details', array('uses' => 'OrderProductController@getSellerTransactionDetailsByOrderId'));
});
