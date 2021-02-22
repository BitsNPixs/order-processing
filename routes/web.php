<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login','Auth\AccountController@getLogin')->name('login')->middleware('guest');
Route::post('/login','Auth\AccountController@postLogin');


Route::group(['middleware' => 'auth'], function (){
    Route::get('/', 'DashboardController@getDashboard')->name('index');

     Route::get('/services', 'ServiceController@getServices')->name('services');

    Route::get('/order-now/{id}', 'PurchaseController@getOrderNow')->name('orderNow');
    Route::post('/order-now/{id}', 'PurchaseController@postOrderNow');

    Route::get('/orders', 'OrderController@getOrders')->name('orders');
    Route::get('/logout', 'Auth\AccountController@getLogout')->name('logout');
});

// Admin Routes
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'],function(){
	Route::get('/login','Auth\AccountController@getLogin')->name('admin.login')->middleware('guest:admin');
	Route::post('/login','Auth\AccountController@postLogin');
	Route::group(['middleware' => 'auth:admin'], function (){
        Route::get('/', function()
        {
            return view('admin.index');
        })->name('admin.index');

        Route::get('/orders/{type?}', 'OrderController@getOrders')->name('adminOrders');

        Route::get('/update-password', 'Auth\AccountController@getUpdatePassword')->name('admin.updatePassword');
	    Route::post('/update-password', 'Auth\AccountController@postUpdatePassword');


	    Route::get('/logout', 'Auth\AccountController@getLogout')->name('admin.logout');
    });
});
