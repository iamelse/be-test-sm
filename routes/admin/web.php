<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RequestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\ProfileController;

Route::prefix('admin')->middleware('is.admin', 'auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user');
        Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::post('/store', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::put('/update/{user}', [UserController::class, 'update'])->name('admin.user.update');
        Route::delete('/destroy/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');
    });

    Route::prefix('vehicle')->group(function () {
        Route::get('/', [VehicleController::class, 'index'])->name('admin.vehicle');
        Route::get('/create', [VehicleController::class, 'create'])->name('admin.vehicle.create');
        Route::post('/store', [VehicleController::class, 'store'])->name('admin.vehicle.store');
        Route::get('/edit/{vehicle}', [VehicleController::class, 'edit'])->name('admin.vehicle.edit');
        Route::put('/update/{vehicle}', [VehicleController::class, 'update'])->name('admin.vehicle.update');
        Route::delete('/destroy/{vehicle}', [VehicleController::class, 'destroy'])->name('admin.vehicle.destroy');
    });

    Route::prefix('request')->group(function () {
        Route::get('/', [RequestController::class, 'index'])->name('admin.request');
        Route::get('/create', [RequestController::class, 'create'])->name('admin.request.create');
        Route::post('/store', [RequestController::class, 'store'])->name('admin.request.store');
        Route::get('/export-request-as-excel',[RequestController::class,'exportRequestAsExcel'])->name('admin.request.export.as.excel');
        Route::get('/export-request-as-csv',[RequestController::class,'exportRequestAsCsv'])->name('admin.request.export.as.csv');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('admin.profile');
        Route::put('/', [ProfileController::class, 'update'])->name('admin.profile.update');
    });
});