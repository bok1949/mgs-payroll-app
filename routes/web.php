<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payroll\EmployeeController;
use App\Http\Controllers\Payroll\WorkingSitesController;
use App\Http\Controllers\Payroll\PayrollDashBoardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('example');
}); */

Route::prefix('/payroll')->group(function() {
    Route::get('/', [PayrollDashBoardController::class, 'payrollDashboard'])->name('payroll-dashboard');

    Route::prefix('/employees')->group(function() {
        Route::get('/list', [EmployeeController::class, 'index'])->name('employee.list');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');
        
    });

    Route::prefix('/working-sites')->group(function () {
        Route::get('/working-sites-index', [WorkingSitesController::class, 'index'])->name('working.sites.index');
        Route::get('/show-employees/{siteId}', [WorkingSitesController::class, 'showEmployees'])->name('working.site.assigned.employees');
        Route::get('/salary-expenses', [WorkingSitesController::class, 'salaryExpensesPersite'])->name('working.site.salary.expenses');
    });

});


