<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=>false]);

Route::group(['prefix'=>'admin','middleware'=>['auth','admin']], function(){
    Route::get('/', 'HomeController@admin')->name('admin');
});

Route::group(['prefix'=>'vendor','middleware'=>['auth','vendor']], function(){
    Route::get('/', 'HomeController@vendor')->name('vendor');
});
Route::group(['prefix'=>'customer','middleware'=>['auth','customer']], function(){
    Route::get('/', 'HomeController@customer')->name('customer');
});

Route::get('/home', 'HomeController@index')->name('home');
