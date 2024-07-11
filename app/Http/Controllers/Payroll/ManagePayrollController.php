<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagePayrollController extends Controller
{
    public function cashAdvanceIndex()
    {
        return view('payroll.payroll-management.cashAdvanceIndex');
    }
}
