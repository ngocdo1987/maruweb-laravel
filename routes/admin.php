<?php
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ConfirmPasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CommonSettingController;
use App\Http\Controllers\Admin\UploadImageController;

Route::name('admin.')->group(function () {
    // Login & logout for admin
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Reset password for admin
    Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    

    Route::group(['middleware' => ['auth:admin']], function () {
        // Role
        Route::resource('roles', RoleController::class);

        // Permission
        Route::resource('permissions', PermissionController::class);

        // Dashboard
        Route::group(['middleware' => ['permission:manage dashboard']], function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        });
        
        // Admin
        Route::group(['middleware' => ['permission:manage admins']], function () {
            Route::resource('admins', AdminController::class);
            Route::post('admins/load-more-activity-logs', [AdminController::class, 'loadMoreActivityLogs'])->name('admins.load_more_activity_logs');
        });

        // Common setting
        Route::group(['middleware' => ['permission:manage common settings']], function () {
            Route::resource('commonSettings', CommonSettingController::class);
        });

        // User
        Route::group(['middleware' => ['permission:manage users']], function () {
            Route::get('users/export-csv', [UserController::class, 'exportCsv'])->name('users.export-csv');
            Route::resource('users', UserController::class);
        });
        
        Route::post('upload-images', [UploadImageController::class, 'store'])->name('images.store');
        Route::post('upload-delete', [UploadImageController::class, 'destroy'])->name('images.delete');
    });
    
 });