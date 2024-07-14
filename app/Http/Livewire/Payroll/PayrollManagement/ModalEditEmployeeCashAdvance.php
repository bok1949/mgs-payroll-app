<?php

namespace App\Http\Livewire\Payroll\PayrollManagement;

use Livewire\Component;
use Illuminate\Support\Carbon;
use App\Models\Payroll\EmployeeCashAdvance;

class ModalEditEmployeeCashAdvance extends Component
{
    protected $listeners = [
        'showModalToEditEmployeeCashAdvance',
    ];

    protected $rules = [
        'amount' => 'required|max:11',
        'cash_advanced_date' => 'required',
        'purpose' => 'nullable',
    ];

    public $empCashAdvanceId, $fullName;
    public $amount, $purpose, $cash_advanced_date;

    public function showModalToEditEmployeeCashAdvance($empCashAdvanceId, $fullName)
    {
        $this->empCashAdvanceId = $empCashAdvanceId;
        $this->fullName = $fullName;
    }

    public function saveCashAdvance()
    {
        $validatedData = $this->validate();
        $validatedData = array_merge($validatedData, [
            'updated_at' => Carbon::now()
        ]);

        try {
            EmployeeCashAdvance::where('id', $this->empCashAdvanceId)
                ->update($validatedData);

            session()->flash('message', 'Cash advance is updated successfully!');
            $this->emit('reRenderParent');
            $this->dispatchBrowserEvent('success-message');
            
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatchBrowserEvent('db-error', ['errormessage' => 'Something went wrong!']);
        }
    }

    public function cancelUpdateCashAdvance()
    {
        $this->reset();
    }

    public function render()
    {
        $empCashAdvance = EmployeeCashAdvance::where('id', $this->empCashAdvanceId)->first();

        $this->amount = $empCashAdvance->amount ?? 0;
        $this->cash_advanced_date = $empCashAdvance->cash_advanced_date ?? '';
        $this->purpose = $empCashAdvance->purpose ?? '';

        return view('livewire.payroll.payroll-management.modal-edit-employee-cash-advance');
    }
}
