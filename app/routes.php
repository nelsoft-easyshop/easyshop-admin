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
    Route::post('users', array('uses' => 'MemberController@doSearchUser'));
    Route::put('user', array('uses' => 'MemberController@ajaxUpdateUsers'));
    Route::get('items',array('uses'=>'ProductController@showAllItems'));
    Route::post('items', array('uses' => 'ProductController@doSearchItem'));
    Route::get('category', array('uses' => 'CategoryController@showAllCategory'));
    Route::post('category', array('uses' => 'CategoryController@doSearchCategory'));
    Route::put('categoryUpdate', array('uses' => 'CategoryController@ajaxUpdateCategory'));
    Route::put('categoryAdd', array('uses' => 'CategoryController@ajaxAddCategory'));
    Route::get('pay', array('uses' => 'OrderController@getUsersToPay'));
    Route::post('transactionRecord', array('uses' => 'HomeController@transactionRecord'));
    Route::get('orderproduct', array('uses' => 'OrderController@getOrderProducts'));
    Route::get('orderproduct-history', array('uses' => 'OrderController@getOrderProductDetail'));
    Route::get('orderproduct-payment', array('uses' => 'OrderController@getOrderProductPaymentDetail'));
});
