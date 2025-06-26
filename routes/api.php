<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (){
    Route::post('login', [AuthController::class, 'login'])->name('login')->middleware('throttle:5,1');

    Route::middleware('auth:api')->group(function () {
        Route::get('/admin/dashboard', [AuthController::class, 'admin_dashbaord'])->middleware('role:admin');
        Route::get('/employer/dashboard', [AuthController::class, 'employer_dashbaord'])->middleware('role:employer');
        Route::get('/candidate/dashboard', [AuthController::class, 'candidate_dashbaord'])->middleware('role:candidate');
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});