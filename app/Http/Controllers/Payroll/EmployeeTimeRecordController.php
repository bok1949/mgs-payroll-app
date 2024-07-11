<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeTimeRecordController extends Controller
{
    public function employeeTimeRecordIndex()
    {
        return view('payroll.time-record-management.employeeTimeRecordIndex');
    }
}
