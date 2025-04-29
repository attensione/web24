<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CompanyController;
use App\Http\Controllers\Api\V1\EmployeeController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get('/test', function (Request $request) { return 'test'; });

Route::apiResource('v1/companies', CompanyController::class)
    ->only(['index', 'store', 'show', 'update', 'destroy']);

Route::apiResource('v1/companies.employees', EmployeeController::class)
    ->only(['index', 'store', 'show', 'update', 'destroy']);