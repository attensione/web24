<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\V1\CompanyController;
use App\Http\Controllers\API\V1\EmployeeController;

Route::controller(AuthController::class)->group(function() {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('v1/companies', CompanyController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::apiResource('v1/companies.employees', EmployeeController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy']);
});