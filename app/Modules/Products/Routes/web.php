<?php
use Illuminate\Support\Facades\Route;
    Route::group(['middleware' => ['web','auth']], function() {
		$namespace = "Products\Controllers";
		Route::namespace($namespace)->group(function () {
			Route::group(["prefix" => LaravelLocalization::setLocale(),"middleware" => [ "localeSessionRedirect", "localizationRedirect", "localeViewPath" ]], function(){
				Route::prefix("backend/products")->group(function () {
                    Route::get('/', 'ProductsController@index')->name('products');
                    Route::get('/create', 'ProductsController@create')->name('create_products');
                    Route::post('/store', 'ProductsController@store')->name('store_products');
                    Route::get('/edit/{id}', 'ProductsController@edit')->name('edit_products');
                    Route::get('/profile', 'ProductsController@profile')->name('profile_products');
                    Route::post('/update/{id}', 'ProductsController@update')->name('update_products');
                    Route::get('/show/{id}', 'ProductsController@show')->name('show_products');
                    Route::get('/delete/{id}', 'ProductsController@destroy')->name('destroy_products');
				});
			});
		});
	});
