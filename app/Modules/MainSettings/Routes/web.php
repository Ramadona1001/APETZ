<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web','auth']], function() {
    $namespace = "MainSettings\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','is_admin','is_admin' ]], function(){
            Route::prefix("backend/main-settings")->group(function () {
                Route::get('/view', 'MainSettingController@index')->name('mainsettings');
                Route::post('/save', 'MainSettingController@save')->name('save_mainsettings');
            });
        });
    });
});
