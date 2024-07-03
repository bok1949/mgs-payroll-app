<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayrollDashBoardController extends Controller
{
    public function payrollDashboard()
    {
        return view('payroll.payroll-dashboard.payrollDashboard');
    }
}
