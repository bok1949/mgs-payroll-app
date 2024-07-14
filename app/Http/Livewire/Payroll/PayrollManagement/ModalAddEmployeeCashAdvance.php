<?php

namespace App\Http\Livewire\Payroll\PayrollManagement;

use App\Models\Payroll\EmployeeCashAdvance;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ModalAddEmployeeCashAdvance extends Component
{
    protected $listeners = [
        'showModalToAddEmployeeCashAdvance',
    ];

    protected $rules = [
        'amount' => 'required|max:11',
        'cash_advanced_date' => 'required',
        'purpose' => 'nullable',
    ];

    public $employeeId, $fullName;
    public $amount, $cash_advanced_date, $purpose;

    public function showModalToAddEmployeeCashAdvance($empId, $fname, $lname)
    {
        $this->fullName = $lname . ', ' . $fname;
        $this->employeeId = (int)$empId;
    }

    public function cancelAddCashAdvance()
    {
        $this->reset();
        $this->emit('reRenderParent');
    }

    public function saveCashAdvance()
    {
        $validatedData = $this->validate();
        $validatedData = array_merge($validatedData, [
            'employee_information_id' => $this->employeeId,
            'created_at' => Carbon::now()
        ]);

        try {
            EmployeeCashAdvance::create($validatedData);

            session()->flash('message', 'Cash advance created!');
            $this->emit('reRenderParent');
            $this->dispatchBrowserEvent('success-message');
            $this->reset(
                'amount',
                'purpose',
                'cash_advanced_date'
            );
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatchBrowserEvent('db-error', ['errormessage' => 'Something went wrong!']);
        }
    }

    public function render()
    {
        return view('livewire.payroll.payroll-management.modal-add-employee-cash-advance');
    }
}
