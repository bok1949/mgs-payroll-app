<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payroll\EmployeeController;
use App\Http\Controllers\Payroll\WorkingSitesController;
use App\Http\Controllers\Payroll\ManagePayrollController;
use App\Http\Controllers\Payroll\PayrollDashBoardController;
use App\Http\Controllers\Payroll\EmployeeTimeRecordController;

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
        Route::get('/working-sites-salary-expenses-index', [WorkingSitesController::class, 'salaryExpensesPersiteIndex'])->name('working.sites.salary.expenses.index');
    });
    
    Route::prefix('/time-record')->group(function() {
        Route::get('/employee-time-record-index', [EmployeeTimeRecordController::class, 'employeeTimeRecordIndex'])->name('employee-time-record-index');
    });

    Route::prefix('/manage-payroll')->group(function() {
        Route::get('/cash-advance', [ManagePayrollController::class, 'cashAdvanceIndex'])->name('cash.advance.index');
        Route::get('/cash-advance/{employeeUuid}', [ManagePayrollController::class, 'viewEmployeeCashAdvancesIndex'])->name('view.cash.advances.index');
        Route::get('/employee-payslip', [ManagePayrollController::class, 'employeePayslipIndex'])->name('employee.payslip.index');
    });

});


