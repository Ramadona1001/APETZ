<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web','auth']], function() {
    $namespace = "Roles\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','is_admin','is_admin' ]], function(){
            Route::prefix("backend/roles")->group(function () {
                Route::get('/all', 'RoleController@index')->name('roles');
                Route::post('/store', 'RoleController@store')->name('store_roles');
                Route::get('/show/{id}', 'RoleController@show')->name('show_roles');
                Route::get('/edit/{id}', 'RoleController@edit')->name('edit_roles');
                Route::post('/update/{id}', 'RoleController@update')->name('update_roles');
                Route::get('/delete/{id}', 'RoleController@destroy')->name('delete_roles');
                Route::get('/permissions/{id}', 'RoleController@permissions')->name('permissions_roles');
                Route::get('/assign/permissions/{id}', 'RoleController@assignPermissions')->name('assign_permissions_roles');

                // Route::get('/permissions', 'PermissionsController@index')->name('permissions');
    //            Route::get('/permissions/store', 'PermissionsController@store')->name('store_permissions');
    //            Route::get('/permissions/update/{id}', 'PermissionsController@update')->name('update_permissions');
    //            Route::get('/permissions/delete/{id}', 'PermissionsController@destroy')->name('delete_permissions');
            });
        });
    });
});
