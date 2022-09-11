<?php

use App\Http\Controllers\Api\v1\EmployeeController;
use App\Http\Controllers\Api\v1\EmployeeSalaryController;
use Illuminate\Support\Facades\Route;

Route::group([ 'prefix' => 'v1' ], function () { // 'middleware' => 'auth:sanctum'
    Route::apiResource('employee', EmployeeController::class);

    Route::apiResource('employeesalary', EmployeeSalaryController::class);
});

Route::get('/ui', 'App\Http\Controllers\Api\ApiSwaggerController@getSwaggerUI')->name('ui');
Route::get('/openapijson', 'App\Http\Controllers\Api\ApiSwaggerController@getSwagger')->name('swagger');
