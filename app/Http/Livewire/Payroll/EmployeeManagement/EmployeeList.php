<?php

namespace App\Http\Livewire\Payroll\EmployeeManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Payroll\WorkingSite;
use App\Models\Payroll\EmployeeInformation;

class EmployeeList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['reRenderParent'];

    public $searchString = '',
        $workingSiteFilter = '',
        $workingSiteName;

    public function reRenderParent()
    {
        $this->render();
    }

    public function clearFilter()
    {
        $this->reset(
            'searchString',
            'workingSiteFilter',
            'workingSiteName'
        );
    }

    public function openModalToUpdateEmployeeInformation($id)
    {
        $this->emit('shownModalToUpdateEmployeeInformation', $id);
    }

    public function openModalToViewEmployeeInformation($id)
    {
        $this->emit('showModalToViewEmployeeInformation', $id);
    }

    public function render()
    {
        $employees = EmployeeInformation::orderBy('employee_information.first_name', 'asc')
            ->select(
                'employee_information.id AS employee_id', 
                'employee_information.gender',
                'employee_information.first_name',
                'employee_information.last_name'
            );
        $sites = WorkingSite::all();

        if (!empty($this->searchString)) {
            $employees->where(function ($query) {
                $query->where('first_name', 'like', '%' . $this->searchString . '%')
                    ->orWhere('last_name', 'like', '%' . $this->searchString . '%');
            });
        }
        if (!empty($this->workingSiteFilter)) {
            $employees->join('employee_working_sites', 'employee_working_sites.employee_information_id', '=', 'employee_information.id');
            $employees->join('working_sites', 'employee_working_sites.working_site_id', '=', 'working_sites.id');
            $employees->where('working_sites.id', '=', $this->workingSiteFilter);
            $this->workingSiteFilter = WorkingSite::select('site_name')->where('id', $this->workingSiteFilter)->first();
            $this->workingSiteName = $this->workingSiteFilter->site_name ?? '';
        }

        $employees = $employees->paginate(25);
        $workingSiteNameCardHeader = $this->workingSiteName ?? 'All Employees';


        return view('livewire.payroll.employee-management.employee-list', compact(
            'employees',
            'sites',
            'workingSiteNameCardHeader'
        ));
    }
}
