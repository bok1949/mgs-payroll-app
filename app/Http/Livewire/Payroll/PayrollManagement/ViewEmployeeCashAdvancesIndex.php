<?php

namespace App\Http\Livewire\Payroll\PayrollManagement;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use App\Models\Payroll\EmployeeCashAdvance;
use App\Models\Payroll\EmployeeInformation;

class ViewEmployeeCashAdvancesIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'filterDateFrom' => 'required',
        'filterDateTo' => 'required',
    ];
    protected $listeners = [
        'reRenderParent',
    ];

    public $empId, $fullName;
    public $filterDateFrom, $filterDateTo;
    public $total, $from, $to, $counter;

    public function reRenderParent()
    {
        $this->render();
    }

    public function mount()
    {
        $employee = EmployeeInformation::find($this->empId);
        $this->fullName = $employee->last_name . ', ' . $employee->first_name;
    }

    public function filterCashAdvanceByDate()
    {
        $this->validate();
        $this->filterDateFrom = Carbon::parse($this->filterDateFrom)->format('Y-m-d');
        $this->filterDateTo = Carbon::parse($this->filterDateTo)->format('Y-m-d');
    }

    public function clearFilter()
    {
        $this->reset(
            'filterDateFrom',
            'filterDateTo'
        );
    }

    public function modalToEditEmployeeCashAdvance($empCashAdvanceId)
    {
        $this->emit('showModalToEditEmployeeCashAdvance', $empCashAdvanceId, $this->fullName);
    }

    public function downloadEmployeeCashAdvance($empCashAdvanceId)
    {
        $cashAdvances = EmployeeCashAdvance::find($empCashAdvanceId);

        $data = [
            'fullName' => $this->fullName,
            'cashAdvances' => $cashAdvances,
        ];

        if (!empty($data)) {
            sleep(3);
            $fileName = $this->fullName . Carbon::now() . '.pdf';
            $pdfContent = PDF::loadView('payroll.payroll-management.cash-advance-download-pages.employeeCashAdvanceDownload', $data)->output();

            return response()->streamDownload(
                fn () => print($pdfContent),
                $fileName
            );
        }
    }

    public function render()
    {
        $cashAdvances = EmployeeCashAdvance::where('employee_information_id', $this->empId)
            ->orderBy('created_at', 'desc');

        if ($this->filterDateFrom && $this->filterDateTo) {
            $cashAdvances->where([
                ['created_at', '>=', $this->filterDateFrom],
                ['created_at', '<=', $this->filterDateTo],
            ]);
        }

        $employeeCashAdvances = $cashAdvances->paginate(25);

        $this->total = $employeeCashAdvances->total();
        $currentPage = $employeeCashAdvances->currentPage();
        $perPage = $employeeCashAdvances->perPage();

        $this->from = ($currentPage - 1) * $perPage + 1;
        $this->to = min($currentPage * $perPage, $this->total);

        $this->counter = $this->from;

        return view('livewire.payroll.payroll-management.view-employee-cash-advances-index', compact('employeeCashAdvances'));
    }
}
