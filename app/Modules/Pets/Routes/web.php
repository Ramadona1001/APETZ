<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web','auth']], function() {
    $namespace = "Pets\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','is_admin' ]], function(){
            Route::prefix("backend/pets")->group(function () {
                Route::get('/', 'PetsController@index')->name('pets');
                Route::get('/create', 'PetsController@create')->name('create_pets');
                Route::post('/store', 'PetsController@store')->name('store_pets');
                Route::get('/edit/{id}', 'PetsController@edit')->name('edit_pets');
                Route::get('/profile', 'PetsController@profile')->name('profile_pets');
                Route::post('/update/{id}', 'PetsController@update')->name('update_pets');
                Route::get('/gallery/{id}', 'PetsController@gallery')->name('gallery_pets');
                Route::get('/view-gallery/{id}', 'PetsController@viewGallery')->name('view_gallery_pets');
                Route::post('/upload-gallery/{id}', 'PetsController@uploadGallery')->name('upload_gallery_pets');
                Route::get('/show/{id}', 'PetsController@show')->name('show_pets');
                Route::get('/delete/{id}', 'PetsController@destroy')->name('destroy_pets');
                Route::get('/delete-media/{id}', 'PetsController@destroyMedia')->name('destroy_media_pets');
            });
        });
    });
});
