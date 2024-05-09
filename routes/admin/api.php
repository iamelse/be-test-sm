<?php

use App\Http\Controllers\Admin\API\RequestController;
use App\Http\Controllers\Admin\API\UserController;
use App\Http\Controllers\Admin\API\VehicleController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('api.admin.user');
    });

    Route::prefix('vehicle')->group(function () {
        Route::get('/', [VehicleController::class, 'index'])->name('api.admin.vehicle');
    });

    Route::prefix('request')->group(function () {
        Route::get('/', [RequestController::class, 'index'])->name('api.admin.request');
    });
});