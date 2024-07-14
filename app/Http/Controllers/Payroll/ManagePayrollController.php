<?php

namespace App\Http\Controllers\Payroll;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payroll\EmployeeInformation;

class ManagePayrollController extends Controller
{
    public function cashAdvanceIndex()
    {
        return view('payroll.payroll-management.cashAdvanceIndex');
    }

    public function employeePayslipIndex()
    {
        return view('payroll.payroll-management.employeePayslipIndex');
    }

    public function viewEmployeeCashAdvancesIndex(Request $request)
    {
        $empInfo = EmployeeInformation::where('employee_uuid', $request->employeeUuid)->first();
        $employeeId = $empInfo->id;

        return view('payroll.payroll-management.viewEmployeeCashAdvancesIndex', compact('employeeId'));

    }
}
