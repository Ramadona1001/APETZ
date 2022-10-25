<?php
use Illuminate\Support\Facades\Route;
	Route::group(["middleware" => ["web","auth"]], function() {
		$namespace = "Orders\Controllers";
		Route::namespace($namespace)->group(function () {
			Route::group(["prefix" => LaravelLocalization::setLocale(),"middleware" => [ "localeSessionRedirect", "localizationRedirect", "localeViewPath" ]], function(){
				Route::prefix("backend/orders")->group(function () {
                    Route::get('/', 'OrdersController@index')->name('orders');
                    Route::get('/create', 'OrdersController@create')->name('create_orders');
                    Route::post('/store', 'OrdersController@store')->name('store_orders');
                    Route::get('/edit/{id}', 'OrdersController@edit')->name('edit_orders');
                    Route::get('/profile', 'OrdersController@profile')->name('profile_orders');
                    Route::post('/update/{id}', 'OrdersController@update')->name('update_orders');
                    Route::get('/show/{id}', 'OrdersController@show')->name('show_orders');
                    Route::get('/print/{id}', 'OrdersController@print')->name('print_orders');
                    Route::get('/delete/{id}', 'OrdersController@destroy')->name('destroy_orders');
				});
			});
		});
	});
