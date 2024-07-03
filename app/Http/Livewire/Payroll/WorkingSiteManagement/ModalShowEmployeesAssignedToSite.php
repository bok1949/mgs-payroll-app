<?php

namespace App\Http\Livewire\Payroll\WorkingSiteManagement;

use App\Models\Payroll\EmployeeWorkingSite;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ModalShowEmployeesAssignedToSite extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'showModalToShowEmployeesInSite',
    ];

    public $searchString, $siteNameModalTitle, $workingSiteId;

    public $jobTitleColumnConstant = 'jobTitle',
        $jobTitleRateColumnConstant = 'jobTitleRate';
    public $employeeId = '',
        $siteIdEdit = '',
        $jobTitleColumn = '',
        $jobTitleRateColumn = '';
    public $empFullName = '';

    public function showModalToShowEmployeesInSite($siteId, $siteName)
    {
        $this->workingSiteId = $siteId;
        $this->siteNameModalTitle = $siteName;
    }

    public function cancelShowEmployeesInSite()
    {
        $this->reset();
        $this->emit('reRenderParent');
    }

    public function cancelCellEditing()
    {
        $this->reset([
            'jobTitleColumn',
            'employeeId',
            'jobTitleRateColumn',
        ]);
    }

    /* set to show text input when cell is clicked */
    public function showEditableInputJobTitle($empId, $columnName)
    {
        $this->employeeId = $empId;
        $this->jobTitleColumn = $columnName;
    }

    /* save job title cell editing value */
    public function saveJobTitle($value)
    {
        try {
            // save into employee_working_sites
            EmployeeWorkingSite::where('employee_information_id', $this->employeeId)
                ->where('working_site_id', $this->workingSiteId)
                ->update([
                    'job_title' => $value,
                    'updated_at' => Carbon::now()
                ]);
    
            $this->cancelCellEditing();
        } catch (\Throwable $th) {
            //throw $th;
            dump($th);
            $this->dispatchBrowserEvent('db-update-error', ['errormessage' => 'Something went wrong! ' . $th]);
        }
    }

    /* set to show text input when cell is clicked */
    public function showEditableInputJobTitleRate($empId, $columnName)
    {
        $this->employeeId = $empId;
        $this->jobTitleRateColumn = $columnName;
    }

    public function saveJobTitleRate($value)
    {
        try {
            // save into employee_working_sites
            EmployeeWorkingSite::where('employee_information_id', $this->employeeId)
                ->where('working_site_id', $this->workingSiteId)
                ->update([
                    'job_title_rate' => $value,
                    'updated_at' => Carbon::now()
                ]);

            $this->cancelCellEditing();
        } catch (\Throwable $th) {
            //throw $th;
            dump($th);
            $this->dispatchBrowserEvent('db-update-error', ['errormessage' => 'Something went wrong! ' . $th]);
        }
    }

    public function render()
    {
        $employeesInWorkingSite = DB::table('employee_information')
            ->select(
                'employee_information.last_name as lastname',
                'employee_information.first_name as firstname',
                'employee_working_sites.employee_information_id',
                'employee_working_sites.working_site_id',
                'working_sites.site_name',
                'employee_working_sites.job_title',
                'employee_working_sites.job_title_rate'
            )
            ->orderBy('employee_information.last_name');
        $employeesInWorkingSite->where('working_sites.id', '=', $this->workingSiteId);

        if (!empty($this->searchString)) {
            $employeesInWorkingSite->where('employee_information.last_name', 'like', "%" . $this->searchString . "%");
        }

        $employeesInWorkingSite->join(
            'employee_working_sites',
            'employee_information.id',
            '=',
            'employee_working_sites.employee_information_id'
        );

        $employeesInWorkingSite->join(
            'working_sites', 
            'employee_working_sites.working_site_id', 
            '=', 
            'working_sites.id'
        );

        $siteEmployees = $employeesInWorkingSite->paginate(5);

        return view('livewire.payroll.working-site-management.modal-show-employees-assigned-to-site', compact('siteEmployees'));
    }
}
