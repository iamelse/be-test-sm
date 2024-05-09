<?php

use App\Http\Controllers\Validator\API\ApprovalController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::prefix('approval')->group(function () {
        Route::get('/', [ApprovalController::class, 'index'])->name('api.validator.approval');
    });
});