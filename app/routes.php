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
    Route::get('cms/slides', array('uses' => 'HomeContentManagerController@getMainSlides'));
    Route::get('cms/productslides', array('uses' => 'HomeContentManagerController@getProductSlides'));

    Route::get('cms/feeds', array('uses' => 'FeedsContentManagerController@getContentFiles'));
    Route::get('cms/featuredProduct', array('uses' => 'FeedsContentManagerController@getFeaturedProducts'));
    Route::get('cms/popularItem', array('uses' => 'FeedsContentManagerController@getPopularItems'));
    Route::get('cms/promoItems', array('uses' => 'FeedsContentManagerController@getPromoItems'));

    Route::get('register', array('uses' => 'AccountController@showRegistration'));
    Route::put('register', array('uses' => 'AccountController@doRegister'));    
    Route::get('managerole', array('uses' => 'AccountController@showAdminLists'));    
    Route::put('adminroles', array('uses' => 'AccountController@updateAdministratorRole'));    
    Route::put('adminactivation', array('uses' => 'AccountController@updateAdministratorActivation'));   

    Route::get('raffle', array('uses' => 'RaffleManagerController@showRaffle'));    
    Route::post('doRaffle', array('uses' => 'RaffleManagerController@doRaffle'));    
    Route::get('showRaffleList', array('uses' => 'RaffleManagerController@showRaffleList'));    
    Route::post('deleteRaffle', array('uses' => 'RaffleManagerController@deleteRaffle'));    

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

});
