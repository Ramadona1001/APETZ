<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web','auth']], function() {
    $namespace = "Translates\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','is_admin','is_admin' ]], function(){
            Route::prefix("backend/translates")->group(function () {
                Route::get('/langs', 'TranslateController@index')->name('langs');
                Route::post('/langs/save', 'TranslateController@save')->name('store_langs');
                Route::post('/langs/new', 'TranslateController@addNew')->name('store_new_langs');
            });
        });
    });
});
