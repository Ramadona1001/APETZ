<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web','auth']], function() {
    $namespace = "Messages\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::prefix("backend/chats")->group(function () {
                Route::get('/all', 'MessagesController@index')->name('chats');
                Route::get('/my-chats', 'MessagesController@myChats')->name('my_chats');
                Route::get('/open-my-chats/{id}', 'MessagesController@openMyChat')->name('open_my_chats');
                Route::get('/create', 'MessagesController@create')->name('create_chats');
                Route::post('/store', 'MessagesController@store')->name('store_chats');
                Route::get('/edit/{id}', 'MessagesController@edit')->name('edit_chats');
                Route::post('/update/{id}', 'MessagesController@update')->name('update_chats');
                Route::get('/show/{id}', 'MessagesController@show')->name('show_chats');
                Route::get('/delete/{id}', 'MessagesController@destroy')->name('destroy_chats');
                Route::post('/upload', 'MessagesController@upload')->name('upload_chats');

                Route::post('/send-message/{chat}', 'MessagesController@sendMessage')->name('send_chat_messages');
            });
        });
    });
});
