<?php

use App\Http\Cpanel\CPanel;
use Illuminate\Support\Facades\Route;

 

Route::group(['as' => 'beauty.', 'prefix' => 'beauty', 'namespace' => 'Beauty'], function () {
    Route::get('/', 'FrontendController@home')->name('home');
    Route::get('/branch', 'FrontendController@branch')->name('branch');
    Route::get('/about', 'FrontendController@about')->name('about');
    Route::get('/team', 'FrontendController@team')->name('team');
    
    Route::get('/contact', 'FrontendController@contact')->name('contact');
    Route::get('/cart', 'FrontendController@cart')->name('cart');
    Route::get('/make_local', 'FrontendController@make_local')->name('make_local');

Route::get('/booking', 'bookingController@index')->name('booking.index');
Route::post('/Add_Time', 'bookingController@Add_Time')->name('Add_Time.index');


    Route::get('/checkout', 'bookingController@checkout')->name('booking.checkout')->middleware('customerbeauty');

    Route::get('/shop', 'shopController@shop')->name('shop');
        Route::post('make_order', 'OrderController@store');

    

Route::get('/Book_now/{id}', 'bookingController@Book_now')->name('booking.Book_now');


    Route::group(['middelware'=>'auth:web'],function(){
        Route::post('/register_user', 'UserController@register_user')->name('register_user');
        Route::post('/login_post', 'UserController@login_post')->name('login_post');
        Route::get('/login', 'UserController@login')->name('login');
        Route::get('/register', 'UserController@register')->name('register');
        Route::post('/logout', 'UserController@logout')->name('logout');
    });

    
    
});
//test