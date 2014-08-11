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

Route::when('*', 'csrf', array('post','put', 'delete'));
#LOGIN
Route::get('login', array('uses' => 'AccountController@showLogin'));
Route::post('login', array('uses' => 'AccountController@doLogin'));

#LOGOUT
Route::get('logout', array('uses' => 'AccountController@doLogout'));

Route::group(array('before' => 'auth'), function(){

    Route::get('/', array('uses' => 'HomeController@index'));    
    
    Route::get('users', array('uses' => 'HomeController@showAllUsers'));
    Route::post('updateUser', array('uses' => 'HomeController@ajaxUpdateUsers'));
    
    Route::get('pay', array('uses' => 'OrderProductController@getUsersToPay'));
    
    Route::get('refund', array('uses' => 'OrderProductController@getUsersToRefund'));
    
    
    
    Route::get('orderproduct', array('uses' => 'OrderProductController@getOrderProducts'));
    Route::get('orderproduct-history', array('uses' => 'OrderProductController@getOrderProductDetail'));
    Route::get('orderproduct-payment', array('uses' => 'OrderProductController@getOrderProductPaymentDetail'));
    Route::put('orderproduct-status/{action}', array('uses' => 'OrderProductController@updateOrderProductStatus'));

    Route::put('billinginfo', array('uses' => 'BillingInfoController@updateOrderProductPaymentAccount'));
    Route::post('billinginfo', array('uses' => 'BillingInfoController@createOrderProductPaymentAccount'));


});


    
