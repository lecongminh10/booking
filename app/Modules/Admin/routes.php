<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Admin\Http\Controllers\OrganizationController;

Route::middleware(['auth:sanctum', 'role:SUPER_ADMIN'])->prefix('organizations')->group(function () {
    Route::get('/', [OrganizationController::class, 'index']);
    Route::post('/', [OrganizationController::class, 'store']);
    Route::get('/{id}', [OrganizationController::class, 'show']);
    Route::put('/{id}', [OrganizationController::class, 'update']);
    Route::delete('/{id}', [OrganizationController::class, 'destroy']);
});


