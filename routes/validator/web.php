<?php

use App\Http\Controllers\Validator\ApprovalController;
use App\Http\Controllers\Validator\DashboardController;
use App\Http\Controllers\Validator\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('validator')->middleware('is.validator', 'auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('validator.dashboard');

    Route::prefix('approval')->group(function () {
        Route::get('/', [ApprovalController::class, 'index'])->name('validator.approval');
        Route::get('/show/{req}', [ApprovalController::class, 'show'])->name('validator.approval.show');
        Route::put('/update/{req}', [ApprovalController::class, 'update'])->name('validator.approval.update');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('validator.profile');
        Route::put('/', [ProfileController::class, 'update'])->name('validator.profile.update');
    });
});