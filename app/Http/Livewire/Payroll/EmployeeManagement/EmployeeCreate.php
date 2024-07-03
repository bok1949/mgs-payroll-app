<?php

namespace App\Http\Livewire\Payroll\EmployeeManagement;

use App\Models\Payroll\EmployeeInformation;
use Livewire\Component;
use Illuminate\Support\Str;

class EmployeeCreate extends Component
{

    public $first_name, $middle_name,
        $last_name, $gender,
        $address, $contact_number,
        $employment_date, $fullName;

    protected $rules = [
        'first_name' => 'required|min:2|max:24',
        'middle_name' => 'nullable',
        'last_name' => 'required|min:2|max:24',
        'gender' => 'required',
        'address' => 'nullable',
        'contact_number' => 'nullable|min:11|max:11',
        'employment_date' => 'nullable',
    ];

    public function storeEmployeeInformation()
    {
        $uuid = Str::uuid()->toString(); //generate uuid
        $validatedData = $this->validate();
        $validatedData = array_merge($validatedData, ['employee_uuid' => $uuid]);
        $this->fullName = $this->first_name . ' ' . $this->last_name;
        EmployeeInformation::create($validatedData);
        session()->flash('message', 'Employee information created!');
        $this->reset(
            'first_name',
            'middle_name',
            'last_name',
            'gender',
            'address',
            'contact_number',
            'employment_date'
        );
    }

    public function render()
    {
        return view('livewire.payroll.employee-management.employee-create');
    }
}
