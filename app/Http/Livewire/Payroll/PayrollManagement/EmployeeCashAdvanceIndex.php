<?php

namespace App\Http\Livewire\Payroll\PayrollManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Payroll\WorkingSite;
use App\Models\Payroll\EmployeeCashAdvance;
use App\Models\Payroll\EmployeeInformation;

class EmployeeCashAdvanceIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'reRenderParent',
    ];

    public $workingSite;
    public $workingSiteName = '', $searchString = '';
    public $from, $to, $total, $counter;

    public function reRenderParent()
    {
        $this->render();
    }

    public function clearFilter()
    {
        $this->reset();
    }

    public function modalToAddEmployeeCashAdvance($empId, $fname, $lname)
    {
        $this->emit('showModalToAddEmployeeCashAdvance', $empId, $fname, $lname);
    }

    public function render()
    {
        $employees = EmployeeInformation::orderby('employee_information.last_name', 'asc')
        ->select(
            'employee_information.id',
            'employee_information.first_name',
            'employee_information.last_name'
        );

        $employees->addSelect([
            'total_amount' => EmployeeCashAdvance::selectRaw('SUM(amount)')
            ->whereColumn('employee_information_id', 'employee_information.id')
        ]);

        if (!empty($this->searchString)) {
            $employees->orWhere('first_name', 'like', "%" . $this->searchString . "%");
            $employees->orWhere('last_name', 'like', "%" . $this->searchString . "%");
        }

        if (!empty($this->workingSite)) {
            $employees->join('employee_working_sites', 'employee_working_sites.employee_information_id', '=', 'employee_information.id');
            $employees->join('working_sites', 'employee_working_sites.working_site_id', '=', 'working_sites.id');
            $employees->where('working_sites.id', '=', $this->workingSite);
            $this->workingSiteName = WorkingSite::select('site_name')->where('id', $this->workingSite)->first();
            $this->workingSiteName = $this->workingSiteName->site_name ?? '';
        }

        $employees = $employees->paginate(25);
        $sites = WorkingSite::all();

        $this->total = $employees->total();
        $currentPage = $employees->currentPage();
        $perPage = $employees->perPage();

        $this->from = ($currentPage - 1) * $perPage + 1;
        $this->to = min($currentPage * $perPage, $this->total);

        $this->counter = $this->from;

        return view('livewire.payroll.payroll-management.employee-cash-advance-index', [
            'employees' => $employees,
            'sites' => $sites,
        ]);
    }
}
