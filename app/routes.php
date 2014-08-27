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



    Route::get('cms/home', array('uses' => 'ContentManagerController@getHomeContent'));
    Route::get('cms/slides', array('uses' => 'ContentManagerController@getMainSlides'));
    Route::get('cms/productslides', array('uses' => 'ContentManagerController@getProductSlides'));

    Route::get('cms/content_files', array('uses' => 'ContentFilesManagerController@getContentFiles'));
    Route::get('cms/featuredProduct', array('uses' => 'ContentFilesManagerController@getFeaturedProducts'));
    Route::get('cms/popularItem', array('uses' => 'ContentFilesManagerController@getPopularItems'));
    Route::get('cms/promoItems', array('uses' => 'ContentFilesManagerController@getPromoItems'));


    Route::post('transactionRecord', array('uses' => 'HomeController@transactionRecord'));

    Route::get('items',array('uses'=>'ProductController@showAllItems'));
    Route::post('items', array('uses' => 'ProductController@doSearchItem'));


    Route::get('pay', array('uses' => 'OrderProductController@getUsersToPay'));

    Route::get('refund', array('uses' => 'OrderProductController@getUsersToRefund'));

    Route::get('orderproduct/pay', array('uses' => 'OrderProductController@getOrderProductsToPay'));
    Route::get('orderproduct/refund', array('uses' => 'OrderProductController@getOrderProductsToRefund'));
    Route::get('orderproduct-detail', array('uses' => 'OrderProductController@getOrderProductDetail'));
    
    Route::get('orderproduct-payment/pay', array('uses' => 'OrderProductController@getOrderProductPaymentDetailToPay'));
    Route::get('orderproduct-payment/refund', array('uses' => 'OrderProductController@getOrderProductPaymentDetailToRefund'));
    Route::put('orderproduct-status/pay', array('uses' => 'OrderProductController@payOrderProducts'));
    Route::put('orderproduct-status/refund', array('uses' => 'OrderProductController@refundOrderProducts'));


    Route::put('billinginfo', array('uses' => 'BillingInfoController@updateOrderProductPaymentAccount'));
    Route::post('billinginfo', array('uses' => 'BillingInfoController@createOrderProductPaymentAccount'));

    
    Route::get('transaction', array('uses' => 'OrderProductController@getAllValidTransactions'));


});
