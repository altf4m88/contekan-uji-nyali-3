<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ReportController;
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

Route::get('/', [DashboardController::class, 'index']);

Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::post('/create-report', [ReportController::class, 'create']);

Route::group(['middleware' => ['auth', 'role:ADMIN']], function(){
    Route::get('/generate-report', [ReportController::class, 'adminReports']);
    Route::get('/admin-dashboard', [DashboardController::class, 'adminDashboard']);
    Route::get('/registration', [RegistrationController::class, 'index']);
    Route::post('/employee-account', [RegistrationController::class, 'create']);
    Route::patch('/employee-account', [RegistrationController::class, 'update']);
    Route::delete('/employee-account', [RegistrationController::class, 'delete']);
    Route::get('/employee-detail', [RegistrationController::class, 'detail']);
    Route::get('/report-detail-admin', [ReportController::class, 'detail']);
    Route::get('/print-report/{id}', [ReportController::class, 'print']);
    Route::get('/print-reports', [ReportController::class, 'printReports']);
});

Route::group(['middleware' => ['auth', 'role:EMPLOYEE']], function(){
    Route::get('/employee-dashboard', [DashboardController::class, 'employeeDashboard']);
    Route::get('/employee-reports', [ReportController::class, 'employeeReports']);
    Route::patch('/report', [ReportController::class, 'update']);
    Route::delete('/report', [ReportController::class, 'delete']);
    Route::get('/report-detail', [ReportController::class, 'detail']);
});
