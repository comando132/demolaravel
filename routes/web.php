<?php

use App\Http\Controllers\EmployeesController;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/employees',  [EmployeesController::class, 'index']);
Route::get('/employees/add',  [EmployeesController::class, 'add'])->name('agregar-empleado');
Route::get('/employees/add/{id}',  [EmployeesController::class, 'add'])->name('editar-empleado');
Route::post('/employees/add',  [EmployeesController::class, 'add'])->name('guardar-empleado');
Route::post('/employees/add/{id}',  [EmployeesController::class, 'add'])->name('editardatos-empleado');
Route::post('/employees/getOffices',  [EmployeesController::class, 'getOffices'])->name('getOffices');
Route::get('/employees/delete/{id}',  [EmployeesController::class, 'delete'])->name('borrar-empleado');

