<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web','auth']], function() {
    $namespace = "UserFollow\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::prefix("backend/user-follows")->group(function () {
                Route::get('/all', 'UserFollowController@index')->name('user_follows');
                Route::post('/follow', 'UserFollowController@follow')->name('save_user_follows');
                Route::get('/user/{id}', 'UserFollowController@user')->name('get_user_follows');
            });
        });
    });
});
