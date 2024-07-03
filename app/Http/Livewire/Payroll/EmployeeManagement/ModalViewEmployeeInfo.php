<?php

namespace App\Http\Livewire\Payroll\EmployeeManagement;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Payroll\EmployeeInformation;

class ModalViewEmployeeInfo extends Component
{
    protected $listeners = [
        'showModalToViewEmployeeInformation',
    ];

    public $first_name, $middle_name, $last_name;
    public $address, $contact_number, $employment_date;
    public $employeeSiteInfo, $employeeId;

    public function showModalToViewEmployeeInformation($empId)
    {
        $employeeInformation = EmployeeInformation::where('id', $empId)
            ->select(
                'first_name',
                'middle_name',
                'last_name',
                'address',
                'contact_number',
                'employment_date'
            )
            ->first();

        $this->employeeId = $empId;

        $this->employeeSiteInfo = DB::table('working_sites')
        ->join('employee_working_sites', 'employee_working_sites.working_site_id', '=', 'working_sites.id')
        ->where('employee_working_sites.employee_information_id', $this->employeeId)
            ->get();

        $this->first_name = $employeeInformation->first_name;
        $this->middle_name = $employeeInformation->middle_name;
        $this->last_name = $employeeInformation->last_name;
        $this->address = $employeeInformation->address;
        $this->contact_number = $employeeInformation->contact_number;
        $this->employment_date = $employeeInformation->employment_date;

        
        // dump($this->employeeSiteInfo);
    }

    public function render()
    {
        return view('livewire.payroll.employee-management.modal-view-employee-info');
    }
}
