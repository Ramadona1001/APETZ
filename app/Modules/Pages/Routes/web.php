<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web','auth']], function() {
    $namespace = "Pages\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','is_admin','is_admin' ]], function(){
            Route::prefix("backend/pages")->group(function () {
                Route::get('/all', 'PageController@index')->name('pages');
                Route::get('/create', 'PageController@create')->name('create_pages');
                Route::post('/store', 'PageController@store')->name('store_pages');
                Route::get('/edit/{id}', 'PageController@edit')->name('edit_pages');
                Route::post('/update/{id}', 'PageController@update')->name('update_pages');
                Route::get('/show/{id}', 'PageController@show')->name('show_pages');
                Route::get('/delete/{id}', 'PageController@destroy')->name('destroy_pages');
                Route::post('/upload', 'PageController@upload')->name('upload_pages');
            });
        });
    });
});
