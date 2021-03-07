<?php
use App\Http\Controllers\Dev\GenerateCodeController;

use Illuminate\Support\Facades\Route;

Route::name('dev.')->group(function () {
    Route::group(['middleware' => ['auth:admin']], function () {
        // Generate code
        Route::get('generate-code', [GenerateCodeController::class, 'index']);
    });
});