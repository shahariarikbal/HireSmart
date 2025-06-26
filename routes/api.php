<?php

use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JobListController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (){
    Route::post('login', [AuthController::class, 'login'])->name('login')->middleware('throttle:5,1');

    Route::middleware('auth:api')->group(function () {
        Route::get('/admin/dashboard', [AuthController::class, 'admin_dashbaord'])->middleware('role:admin');
        Route::get('/employer/dashboard', [AuthController::class, 'employer_dashbaord'])->middleware('role:employer');
        Route::get('/candidate/dashboard', [AuthController::class, 'candidate_dashbaord'])->middleware('role:candidate');
        // Logout route
        Route::post('/logout', [AuthController::class, 'logout']);

        //Job listings
        Route::prefix('/job')->middleware('role:employer')->group(function () {
            Route::get('/list', [JobListController::class, 'getJobList']);
            Route::post('/store', [JobListController::class, 'storeJob']);
            Route::put('/update/{id}', [JobListController::class, 'updateJob']);
            Route::get('/show/{id}', [JobListController::class, 'showJob']);
            Route::delete('/delete/{id}', [JobListController::class, 'deleteJob']);
        });
        
        // Candidate application routes
        Route::prefix('/job')->middleware('role:candidate')->group(function (){
            Route::get('/list', [ApplicationController::class, 'getAllJobList']);
            Route::get('/filtering', [ApplicationController::class, 'jobFiltering']);
            Route::post('/apply/{id}', [ApplicationController::class, 'jobApply'])->middleware('throttle:5,1');
        });
        
    });
});