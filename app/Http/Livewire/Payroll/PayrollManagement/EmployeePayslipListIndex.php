<?php

namespace App\Http\Livewire\Payroll\PayrollManagement;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use App\Models\Payroll\WorkingSite;
use App\Models\Payroll\EmployeeTimeRecord;
use App\Models\Payroll\EmployeeCashAdvance;
use App\Models\Payroll\EmployeeInformation;
use App\Models\Payroll\EmployeeWorkingSite;

class EmployeePayslipListIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $sites, $monthFilter, $searchString, $workingSiteFilter;
    public $filterFrom, $filterTo;
    public $workingSiteName;
    public $total, $from, $to, $counter;
    public $employeeGrossSalary = [], $employeeNetSalary = [];

    public function mount()
    {
        $this->sites = WorkingSite::orderBy('site_name', 'asc')->get();
    }

    public function clearFilter()
    {
        $this->reset(
            'workingSiteName',
            'filterFrom',
            'filterTo',
            'searchString',
            'monthFilter',
            'workingSiteFilter'
        );
    }

    public function downloadEmployeePayroll($empId, $totalDays, $totalOT, $totalCashAdvance)
    {
        $month = Carbon::create($this->monthFilter)->format('F');
        $employee = EmployeeInformation::where('id', $empId)
            ->select('first_name', 'last_name')->first();
        $fullName = $employee->first_name . ' ' . $employee->last_name;
        
        $employeeWorkingSites = EmployeeWorkingSite::where('employee_information_id', $empId)
            ->join('working_sites', 'working_sites.id', '=', 'employee_working_sites.working_site_id')
            ->select(
                'employee_working_sites.job_title',
                'employee_working_sites.job_title_rate',
                'working_sites.site_name',
            )
            ->get();

        $jobTitleStr = "";
        $jobRateStr = "";
        $siteStr = "";
        foreach ($employeeWorkingSites as $employeeWorkingSite) {
            $jobTitleStr .= $employeeWorkingSite->job_title . ',' ?? '';
            $jobRateStr .= $employeeWorkingSite->job_title_rate . ',' ?? '';
            $siteStr .= $employeeWorkingSite->site_name . ',' ?? '';
        }

        $jobTitleStr = rtrim($jobTitleStr, ',');
        $jobRateStr = rtrim($jobRateStr, ',');
        $siteStr = rtrim($siteStr, ',');

        $data = [
            'emp_name' => $fullName,
            'emp_job_title' => $jobTitleStr,
            'emp_rate' => $jobRateStr,
            'emp_site' => $siteStr,
            'monthFilter' => $month,
            'emp_days' => $totalDays,
            'emp_total_ot' => $totalOT,
            'emp_gross_total' => $this->employeeGrossSalary[$empId],
            'emp_deductions' => $totalCashAdvance,
            'emp_final_pay' => $this->employeeNetSalary[$empId],
        ];

        if (!empty($data)) {
            sleep(3);
            $fileName = $fullName . Carbon::now() . '.pdf';
            $pdfContent = PDF::loadView('payroll.payroll-management.payslip-download-pages.download-single-payslip', $data)->output();

            return response()->streamDownload(
                fn () => print($pdfContent),
                $fileName
            );
        }
    }
    
    public function render()
    {
        $employees = EmployeeInformation::orderBy('last_name', 'asc')
            ->select('employee_information.id AS employee_id', 'employee_information.*');
            
        if ($this->monthFilter) {
            $this->filterFrom = Carbon::create($this->monthFilter)->startOfMonth()->format('Y-m-d');
            $this->filterTo = Carbon::create($this->monthFilter)->endOfMonth()->format('Y-m-d');
        }

        $employees->addSelect([
            'sumOfDaysPresent' => EmployeeTimeRecord::selectRaw('SUM(days_present)')
            ->whereColumn('employee_id', 'employee_information.id')
            ->whereBetween('attendance_from', [
                $this->filterFrom ?? Carbon::now()->startOfMonth()->format('Y-m-d'),
                $this->filterTo ?? Carbon::now()->endOfMonth()->format('Y-m-d'),
            ])
        ]);

        $employees->addSelect([
            'sumOfOverTime' => EmployeeTimeRecord::selectRaw('SUM(total_ot)')
            ->whereColumn('employee_id', 'employee_information.id')
            ->whereBetween('attendance_from', [
                $this->filterFrom ?? Carbon::now()->startOfMonth()->format('Y-m-d'),
                $this->filterTo ?? Carbon::now()->endOfMonth()->format('Y-m-d'),
                ])
            ]);
            
            $employees->addSelect([
                'cashAdvanceSum' => EmployeeCashAdvance::selectRaw('SUM(amount)')
            ->whereColumn('employee_information_id', 'employee_information.id')
            ->whereBetween('cash_advanced_date', [
                $this->filterFrom ?? Carbon::now()->startOfMonth()->format('Y-m-d'),
                $this->filterTo ?? Carbon::now()->endOfMonth()->format('Y-m-d'),
                ])
            ]);
            
            if (!empty($this->searchString)) {
                $employees->orWhere('first_name', 'like', "%" . $this->searchString . "%");
                $employees->orWhere('last_name', 'like', "%" . $this->searchString . "%");
            }
            
            if (!empty($this->workingSiteFilter)) {
            $employees->join('employee_working_sites', 'employee_working_sites.employee_information_id', '=', 'employee_information.id');
            $employees->join('working_sites', 'employee_working_sites.working_site_id', '=', 'working_sites.id');
            $employees->where('working_sites.id', '=', $this->workingSiteFilter);
            $this->workingSiteName = WorkingSite::select('site_name')->where('id', $this->workingSiteFilter)->first();
            $this->workingSiteName = $this->workingSiteName->site_name ?? '';
        }

        $employees = $employees->paginate(25);

        foreach ($employees as $key => $employee) {
            $this->getEmployeeGrossNetSalary($employee->employee_id);
            $this->employeeNetSalary[$employee->employee_id] = 
                $this->employeeGrossSalary[$employee->employee_id] - $employee->cashAdvanceSum;
        }

        $this->total = $employees->total();
        $currentPage = $employees->currentPage();
        $perPage = $employees->perPage();

        $this->from = ($currentPage - 1) * $perPage + 1;
        $this->to = min($currentPage * $perPage, $this->total);

        $this->counter = $this->from;
        
        return view('livewire.payroll.payroll-management.employee-payslip-list-index', compact('employees'));
    }

    private function getEmployeeGrossNetSalary($employeeId)
    {
        $employeeWorkingSites = EmployeeWorkingSite::where('employee_information_id', $employeeId)->get();
        $daysTotalSalary = 0;
        $otTotalSalary = 0;
        $from = $this->filterFrom ? $this->filterFrom : Carbon::now()->startOfMonth()->format('Y-m-d');
        $to = $this->filterTo ? $this->filterTo : Carbon::now()->endOfMonth()->format('Y-m-d');        
        foreach ($employeeWorkingSites as $employeeWorkingSite) {
            $employeeDaysOt = EmployeeTimeRecord::where('employee_id', $employeeId)
                ->where('site_id', $employeeWorkingSite->working_site_id)
                ->whereBetween('attendance_from', [$from, $to])
                ->first();
    
            $jobRate = !is_null($employeeWorkingSite->job_title_rate)
                ? $employeeWorkingSite->job_title_rate
                : 0;
            
            $days = $employeeDaysOt && !is_null($employeeDaysOt->days_present)
                ? $employeeDaysOt->days_present
                : 0;
            $ot =  $employeeDaysOt && !is_null($employeeDaysOt->total_ot)
                ? $employeeDaysOt->total_ot
                : 0;
            
            $otTotalSalary += ($jobRate / 8) * $ot;
            $daysTotalSalary += $jobRate * $days;
        }
       
        $this->employeeGrossSalary[$employeeId] = $daysTotalSalary + $otTotalSalary;
    }
}
