<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;

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
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/companies', [AuthController::class, 'getCompany']);
    Route::get('/employees', [AuthController::class, 'getEmployee']);

    Route::get('/companies/{id}', [AuthController::class, 'showCompany']);
    Route::post('/create/companies', [AuthController::class, 'storeCompany']);
    Route::put('/update/companies/{id}', [AuthController::class, 'updateCompany']);
    Route::delete('/delete/companies/{id}', [AuthController::class, 'destroyCompany']);

    Route::get('/employee/{id}', [AuthController::class, 'showEmployee']);
    Route::post('/create/employee', [AuthController::class, 'createEmployee']);
    Route::put('/update/employee/{id}', [AuthController::class, 'updateEmployee']);
    Route::delete('/delete/employee/{id}', [AuthController::class, 'destroyEmployee']);
});