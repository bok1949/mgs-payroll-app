<?php

namespace App\Http\Livewire\Payroll\EmployeeManagement;

use Livewire\Component;
use Illuminate\Support\Carbon;
use App\Models\Payroll\EmployeeInformation;

class ModalUpdateEmployeeInfo extends Component
{
    protected $listeners = [
        'shownModalToUpdateEmployeeInformation',
    ];

    protected $rules = [
        'first_name' => 'required|min:2|max:24',
        'middle_name' => 'nullable',
        'last_name' => 'required|min:2|max:24',
        'gender' => 'required',
        'address' => 'nullable',
        'contact_number' => 'nullable|min:11|max:11',
        'employment_date' => 'nullable',
    ];

    public $employeeId, $first_name, 
        $middle_name, $last_name,
        $gender, $address, 
        $contact_number, $employment_date,
        $fullName;

    public function shownModalToUpdateEmployeeInformation($empId)
    {
        $employeeInformation = EmployeeInformation::where('id', $empId)
            ->select(
                'first_name',
                'middle_name',
                'last_name',
                'gender',
                'address',
                'contact_number',
                'employment_date'
            )
            ->first();
        $this->employeeId = $empId;
        $this->first_name = $employeeInformation->first_name;
        $this->middle_name = $employeeInformation->middle_name;
        $this->last_name = $employeeInformation->last_name;
        $this->gender = $employeeInformation->gender;
        $this->address = $employeeInformation->address;
        $this->contact_number = $employeeInformation->contact_number;
        $this->employment_date = $employeeInformation->employment_date;
    }

    public function saveChanges()
    {
        $validatedData = $this->validate();
        $validatedData = array_merge($validatedData, ['updated_at' => Carbon::now()]);

        EmployeeInformation::where('id', $this->employeeId)
            ->update($validatedData);

        $this->fullName = $this->last_name . ', ' . $this->first_name;

        session()->flash('message', ' information is updated successfully!');
        $this->emit('reRenderParent');
    }

    public function cancelUpdate()
    {
        $this->emit('reRenderParent');
    }

    public function render()
    {
        return view('livewire.payroll.employee-management.modal-update-employee-info');
    }
}
