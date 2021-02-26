<?php

use App\Http\Controllers\API\EmployeeApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/employee', [EmployeeApiController::class, 'index']);
Route::get('/getEmployee/{emp}', [EmployeeApiController::class, 'getEmployee']);
Route::get('/catalogos/{catalogo}', [EmployeeApiController::class, 'getCatalogo']);
Route::post('/employee', [EmployeeApiController::class, 'add']);
Route::post('/employee/{id}', [EmployeeApiController::class, 'update']);
Route::delete('/employee/{id}', [EmployeeApiController::class, 'delete']);
