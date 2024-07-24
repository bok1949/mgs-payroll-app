<?php

namespace App\Http\Livewire\Payroll\EmployeeManagement;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Payroll\EmployeeInformation;

class ModalCreateEmployee extends Component
{
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
        $contact_number, $employment_date;

    public function cancelCreate()
    {
        $this->reset();
    }

    public function saveEmployeeInformation()
    {
        $validatedData = $this->validate();
        $this->first_name = Str::title(Str::lower($this->first_name));
        $this->last_name = Str::title(Str::lower($this->last_name));
        $this->middle_name = Str::title(Str::lower($this->middle_name));
        $uuid = Str::uuid()->toString(); //generate uuid
        $validatedData = array_merge($validatedData, ['employee_uuid' => $uuid, 'created_at' => Carbon::now()]);
        $fullName = $this->first_name . ' ' . $this->last_name;
        $validatedData['first_name'] = $this->first_name;
        $validatedData['middle_name'] = $this->middle_name;
        $validatedData['last_name'] = $this->last_name;

        try {
            EmployeeInformation::create($validatedData);
            session()->flash('message', $fullName . ' information is successfully created!');
            $this->dispatchBrowserEvent('success-message');
            $this->reset();
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatchBrowserEvent('db-error', ['errormessage' => 'Something went wrong!']);
        }
    }

    public function render()
    {
        return view('livewire.payroll.employee-management.modal-create-employee');
    }
}
