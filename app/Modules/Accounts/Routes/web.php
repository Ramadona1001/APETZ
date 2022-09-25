<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web','auth']], function() {
    $namespace = "Accounts\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','is_admin' ]], function(){
            Route::prefix("backend/users")->group(function () {
                Route::get('/', 'UserController@index')->name('users');
                Route::get('/create', 'UserController@create')->name('create_users');
                Route::post('/store', 'UserController@store')->name('store_users');
                Route::get('/edit/{id}', 'UserController@edit')->name('edit_users');
                Route::get('/profile', 'UserController@profile')->name('profile_users');
                Route::post('/update/{id}', 'UserController@update')->name('update_users');
                Route::get('/show/{id}', 'UserController@show')->name('show_users');
                Route::get('/delete/{id}', 'UserController@destroy')->name('destroy_users');
                Route::get('/logout', 'UserController@logout')->name('logout_users');
            });
        });
    });
});
