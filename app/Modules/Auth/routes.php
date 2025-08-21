<?php

use App\Modules\Auth\Http\Controllers\SuperAdminAuthController;
use Illuminate\Support\Facades\Route;
use App\Modules\Auth\Http\Controllers\AuthController;
use App\Modules\Auth\Http\Controllers\ClubAdminAuthController;
use App\Modules\Auth\Http\Controllers\StoreManagerAuthController;

Route::prefix('super-admin')->group(function () {
    Route::post('login', [SuperAdminAuthController::class, 'login']);
    Route::post('logout', [SuperAdminAuthController::class, 'logout'])->middleware('auth:api');
    Route::post('register', [SuperAdminAuthController::class, 'register']);
});

Route::prefix('club-admin')->group(function () {
    Route::post('login', [ClubAdminAuthController::class, 'login']);
    Route::post('logout', [ClubAdminAuthController::class, 'logout'])->middleware('auth:api');
});

Route::prefix('store-manager')->group(function () {
    Route::post('login', [StoreManagerAuthController::class, 'login']);
    Route::post('logout', [StoreManagerAuthController::class, 'logout'])->middleware('auth:api');
});

