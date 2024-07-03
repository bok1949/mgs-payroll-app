<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index()
    {
        return view('payroll.employee-management.employeeList');
    }

    public function create()
    {
        return view('payroll.employee-management.employeeCreate');
    }

}
