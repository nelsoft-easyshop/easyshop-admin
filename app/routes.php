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
    Route::put('users', array('uses' => 'MemberController@ajaxUpdateUsers'));

    Route::get('cms/home', array('uses' => 'NewHomeContentManagerController@getHomeContent'));
    Route::get('cms/getSlideSection/{index}', array('uses' => 'NewHomeContentManagerController@getSlideSection'));
    Route::get('cms/getSubCategoryNavigation/{index}', array('uses' => 'NewHomeContentManagerController@getSubCategoryNavigation'));
    Route::get('cms/getBrandsSection', array('uses' => 'NewHomeContentManagerController@getBrandsSection'));
    Route::get('cms/getCategoriesPanel', array('uses' => 'NewHomeContentManagerController@getAllCategories'));
    Route::get('cms/getNewArrivals', array('uses' => 'NewHomeContentManagerController@getNewArrivals'));
    Route::get('cms/getTopProducts', array('uses' => 'NewHomeContentManagerController@getTopProducts'));
    Route::get('cms/getTopSellers', array('uses' => 'NewHomeContentManagerController@getTopSellers'));
    Route::get('cms/getAllSliders', array('uses' => 'NewHomeContentManagerController@getAllSliders'));
    Route::get('cms/getProductPanel', array('uses' => 'NewHomeContentManagerController@getProductPanel'));
    Route::get('cms/getAdsSection', array('uses' => 'NewHomeContentManagerController@getAdSection'));
    Route::get('cms/getOtherCategories', array('uses' => 'NewHomeContentManagerController@getOtherCategories'));
    Route::get('cms/getSubCategoriesSection/{index}', array('uses' => 'NewHomeContentManagerController@getSubCategoriesSection'));
    Route::get('cms/getCategoriesProductPanel/{index}', array('uses' => 'NewHomeContentManagerController@getCategoriesProductPanel'));
    Route::post('cms/getSliderPreview', array('uses' => 'NewHomeContentManagerController@getSliderPreview'));

    Route::get('cms/slides', array('uses' => 'HomeContentManagerController@getMainSlides'));
    Route::get('cms/productslides', array('uses' => 'HomeContentManagerController@getProductSlides'));

    Route::get('cms/feeds', array('uses' => 'FeedsContentManagerController@getContentFiles'));
    Route::get('cms/featuredProduct', array('uses' => 'FeedsContentManagerController@getFeaturedProducts'));
    Route::get('cms/popularItem', array('uses' => 'FeedsContentManagerController@getPopularItems'));
    Route::get('cms/promoItems', array('uses' => 'FeedsContentManagerController@getPromoItems'));
    
    Route::get('cms/mobile', array('uses' => 'MobileContentManagerController@showMobileCms'));
    Route::get('cms/mobileSlides', array('uses' => 'MobileContentManagerController@getMainSlides'));

    Route::get('register', array('uses' => 'AccountController@showRegistration'));
    Route::put('register', array('uses' => 'AccountController@doRegister'));    
    Route::get('managerole', array('uses' => 'AccountController@showAdminLists'));    
    Route::put('adminroles', array('uses' => 'AccountController@updateAdministratorRole'));    
    Route::put('adminactivation', array('uses' => 'AccountController@updateAdministratorActivation'));   
    Route::put('getadminaccount', array('uses' => 'AccountController@getAdminAccount'));   
    Route::put('resetPassword', array('uses' => 'AccountController@resetPassword'));   

    Route::get('raffle', array('uses' => 'RaffleManagerController@showRaffle'));    
    Route::post('raffle/doRaffle', array('uses' => 'RaffleManagerController@doRaffle'));    
    Route::get('raffle/showRaffleList', array('uses' => 'RaffleManagerController@showRaffleList'));    
    Route::post('raffle/deleteRaffle', array('uses' => 'RaffleManagerController@deleteRaffle'));  

    Route::get('messages', array('uses' => 'MessageController@showMessages'));    
    Route::post('getmessage', array('uses' => 'MessageController@getConversation'));    
    Route::post('getInbox', array('uses' => 'MessageController@getAllMessages'));    
    Route::post('sendMessage', array('uses' => 'MessageController@sendMessage'));    
    Route::get("refreshConversation/{to_id}/{from_id}", array('uses' => 'MessageController@refreshConversation'));    

    Route::get("productcsv", array('uses' => 'ProductCSVController@showCSVupload'));    
    Route::post("productcsv", array('uses' => 'ProductCSVController@doUpload'));    

    Route::get("reports", array('uses' => 'ReportsController@showReportsConsole'));    

    Route::get('searchkeywords', array('uses' => 'SearchKeyWordsController@showSearchKeyWords'));    
    Route::post('searchkeywords', array('uses' => 'SearchKeyWordsController@showSearchKeyWords'));    

    Route::get('category', array('uses' => 'CategoryController@showAllCategory'));
    Route::post('category', array('uses' => 'CategoryController@doSearchCategory'));
    Route::put('category/categoryUpdate', array('uses' => 'CategoryController@ajaxUpdateCategory'));
    Route::put('category/categoryAdd', array('uses' => 'CategoryController@ajaxAddCategory'));

    Route::get('items',array('uses'=>'ProductController@showAllItems'));
    Route::post('items', array('uses' => 'ProductController@showAllItems'));

    Route::get('transaction/pay', array('uses' => 'OrderProductController@getUsersToPay'));
    Route::get('transaction/refund', array('uses' => 'OrderProductController@getUsersToRefund'));
    Route::get('transaction/orderproduct/pay', array('uses' => 'OrderProductController@getOrderProductsToPay'));
    Route::get('transaction/orderproduct/refund', array('uses' => 'OrderProductController@getOrderProductsToRefund'));
    Route::get('transaction/orderproduct-detail', array('uses' => 'OrderProductController@getOrderProductDetail'));
    Route::get('transaction/orderproduct-payment/pay', array('uses' => 'OrderProductController@getOrderProductPaymentDetailToPay'));
    Route::get('transaction/orderproduct-payment/refund', array('uses' => 'OrderProductController@getOrderProductPaymentDetailToRefund'));
    Route::put('transaction/orderproduct-status/pay', array('uses' => 'OrderProductController@payOrderProducts'));
    Route::get('transaction/orderproduct-download', array('uses' => 'OrderProductController@downloadTransactionRecord'));
    Route::put('transaction/orderproduct-status/refund', array('uses' => 'OrderProductController@refundOrderProducts'));
    Route::put('transaction/billinginfo', array('uses' => 'BillingInfoController@updateOrderProductPaymentAccount'));
    Route::post('transaction/billinginfo', array('uses' => 'BillingInfoController@createOrderProductPaymentAccount'));

    Route::get('transaction', array('uses' => 'OrderController@getAllValidOrders'));
    Route::get('transaction/order-detail', array('uses' => 'OrderController@getOrderDetail'));
    Route::put('transaction/order-void', array('uses' => 'OrderController@voidOrder'));
    Route::put('transaction/order-product-void', array('uses' => 'OrderProductController@voidOrderProduct'));

    Route::get('prohibited', array('uses' => 'AccountController@prohibited'));

    Route::get('contact/seller', array('uses' => 'OrderProductController@getSellersTransactions'));
    Route::post('contact/seller', array('uses' => 'OrderProductController@getSellersTransactions'));
    Route::get('contact/seller/view-transactions-details', array('uses' => 'OrderProductController@getSellerTransactionDetailsByOrderId'));
    Route::get('contact/seller/add-transactions-details', array('uses' => 'OrderProductController@getAddShippingDetailsView'));
    Route::get('contact/seller/update-transaction', array('uses' => 'OrderProductController@updateOrderProductTagStatus'));
    Route::get('contact/seller/view-transaction-shipping', array('uses' => 'OrderProductController@getOrderProductShippingDetails'));
    Route::get('contact/buyer', array('uses' => 'OrderProductController@getOrderProductsContactBuyer'));   
    Route::post('contact/buyer', array('uses' => 'OrderProductController@getOrderProductsContactBuyer'));   
    Route::get('contact/buyer/view-transaction-details', array('uses' => 'OrderProductController@getBuyerTransactionDetailsByOrderId'));
    Route::get('contact/shippingdetails/add', array('uses' => 'OrderProductController@addShippingDetails'));

});
