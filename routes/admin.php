<?php

Route::namespace('Admin')->name('admin.')->group(function () {
    // Login & logout for admin
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login.form');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    // Reset password for admin
    Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

    Route::group(['middleware' => ['auth:admin']], function () {
        // Role
        Route::resource('roles', 'RoleController');

        // Permission
        Route::resource('permissions', 'PermissionController');

        // Dashboard
        Route::group(['middleware' => ['permission:manage dashboard']], function () {
            Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        });
        
        // Admin
        Route::group(['middleware' => ['permission:manage admins']], function () {
            Route::resource('admins', 'AdminController');
            Route::post('admins/load-more-activity-logs', 'AdminController@loadMoreActivityLogs')->name('admins.load_more_activity_logs');
        });

        // Common setting
        Route::group(['middleware' => ['permission:manage common settings']], function () {
            Route::resource('commonSettings', 'CommonSettingController');
        });

        // User
        Route::group(['middleware' => ['permission:manage users']], function () {
            Route::get('users/export-csv', 'UserController@exportCsv')->name('users.export-csv');
            Route::resource('users', 'UserController');
        });
        
        Route::post('upload-images', 'UploadImageController@store')->name('images.store');
        Route::post('upload-delete', 'UploadImageController@destroy')->name('images.delete');
    });
    
 });