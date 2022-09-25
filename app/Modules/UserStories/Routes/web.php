<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web','auth']], function() {
    $namespace = "UserStories\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::prefix("backend/user-stories")->group(function () {
                Route::get('/all', 'UserStoriesController@index')->name('user_stories');
                Route::get('/create', 'UserStoriesController@create')->name('create_stories');
            });
        });
    });
});
