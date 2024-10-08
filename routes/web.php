<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payroll\AuthController;
use App\Http\Controllers\Payroll\EmployeeController;
use App\Http\Controllers\Payroll\UserAccountController;
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



Route::prefix('/payroll')->group(function() {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/post-login', [AuthController::class, 'postLogin'])->name('post.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'isPayrollPersonnel'])->group(function() {

        Route::get('/dashboard', [PayrollDashBoardController::class, 'payrollDashboard'])->name('payroll-dashboard');
    
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

        Route::prefix('/user')->group(function() {
            Route::get('/profile', [UserAccountController::class, 'userAccountProfile'])->name('account.profile');
            Route::post('/profile-update', [UserAccountController::class, 'postUserAccountProfile'])->name('post.accountProfile');
            Route::get('/settings', [UserAccountController::class, 'userAccountSettings'])->name('account.settings');
            Route::post('/settings-new-password', [UserAccountController::class, 'postUserAccountSettingsChangePassword'])->name('account.settings.saveNewPassword');
        });

    });

});


