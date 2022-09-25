<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web','auth']], function() {
    $namespace = "Blogs\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::prefix("backend/blogs")->group(function () {
                Route::get('/all', 'BlogController@index')->name('blogs');
                Route::get('/create', 'BlogController@create')->name('create_blogs');
                Route::post('/store', 'BlogController@store')->name('store_blogs');
                Route::get('/edit/{id}', 'BlogController@edit')->name('edit_blogs');
                Route::post('/update/{id}', 'BlogController@update')->name('update_blogs');
                Route::get('/show/{id}', 'BlogController@show')->name('show_blogs');
                Route::get('/delete/{id}', 'BlogController@destroy')->name('destroy_blogs');
                Route::post('/upload', 'BlogController@upload')->name('upload_blogs');
                Route::get('/comments/{id}', 'BlogController@comments')->name('comments_blogs');
                Route::get('/share/{id}', 'BlogController@share')->name('share_blogs');
                Route::get('/reactions/{id}', 'BlogController@reactions')->name('reactions_blogs');
                Route::get('/gallery/{id}', 'BlogController@gallery')->name('gallery_blogs');
                Route::get('/view-gallery/{id}', 'BlogController@viewGallery')->name('view_gallery_blogs');
                Route::post('/upload-gallery/{id}', 'BlogController@uploadGallery')->name('upload_gallery_blogs');
                Route::get('/delete-media/{id}', 'BlogController@destroyMedia')->name('destroy_media_blogs');
            });
            Route::prefix("backend/blogs-comments")->group(function () {
                Route::get('/{id}', 'BlogController@comments')->name('comments_blogs');
                Route::get('/publish/{id}/{publish}', 'BlogController@publishComments')->name('publish_comments_blogs');
                Route::get('/delete/{id}', 'BlogController@destroyComments')->name('destroy_comments_blogs');
            });
        });
    });
});
