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

Route::get('/', 'FrontendController@homepage')->name('landing');

Route::get('/signup','FrontendController@signup')->name('signup');
Route::post('/signup','UserController@registerUser')->name('signup-process');

Route::get('/activate/{user_id}/{token}','UserController@activateUser')->name('activate');

Route::get('/help-and-faq.html','PageController@getHelpAndFaq')->name('help-and-faq');
Route::get('/about-us.html','PageController@getAboutUs')->name('about-us');

Auth::routes(['register'=>false]);

Route::get('/shop','ProductController@getAllProducts')->name('all-products');

Route::get('/product/{slug}','ProductController@show')->name('product-detail');
Route::get('/category/{slug}','CategoryController@show')->name('category-list');
Route::get('/category/{slug}/{sub_slug}','CategoryController@subCategoryShow')->name('sub-category-list');

Route::post('/review/{product_id}','FrontendController@submitReview')->name('product-review');
Route::post('/cart/add','FrontendController@addToCart')->name('add-to-cart');

Route::get('/cart','FrontendController@showCart')->name('cart');
Route::get('/checkout','FrontendController@checkout')->name('checkout')->middleware('auth');

Route::get('/esewa','FrontendController@esewaPay')->name('esewa');

Route::group(['prefix'=>'admin','middleware'=>['auth','admin']], function(){
    Route::get('/', 'HomeController@admin')->name('admin');

    Route::get('/file-manager',function(){
        return view('admin.pages.filemanager');
    })->name('file-manager')->middleware('auth');

    Route::resource('banner','BannerController')->except('show');
    Route::resource('category','CategoryController');
    Route::resource('product','ProductController');
    Route::resource('pages','PageController')->except(['create','store','destroy']);

    Route::post('/category/{id}/child','CategoryController@getChildCategory');
});

Route::group(['prefix'=>'vendor','middleware'=>['auth','vendor']], function(){
    Route::get('/', 'HomeController@vendor')->name('vendor');
});
Route::group(['prefix'=>'customer','middleware'=>['auth','customer']], function(){
    Route::get('/', 'HomeController@customer')->name('customer');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
    // list all lfm routes here...
});

Route::get('/home', 'HomeController@index')->name('home');
