<?php

namespace App\Http\Livewire\Payroll\WorkingSiteManagement;

use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Payroll\EmployeeInformation;
use App\Models\Payroll\EmployeeWorkingSite;

class ModalAddEmployeeToSite extends Component
{
    protected $listeners = [
        'showModalToAddEmployeeInSite',
    ];

    public $searchQueryString, $employees;
    public $siteNameModalTitle;
    public $workingSiteId, $selectedEmployees = [];

    public function cancelAddingEmployeeToSite()
    {
        $this->reset();
        $this->emit('reRenderParent');
    }

    public function showModalToAddEmployeeInSite($siteId, $siteName)
    {
        $this->workingSiteId = $siteId;
        $this->siteNameModalTitle = $siteName;
    }

    public function selectedEmployeesFromList($empId, $lastName, $firstName)
    {
        if ($this->findEmployeeInWorkingSite($empId)) {
            session()->flash('error-adding-employee-to-site', $lastName . ', ' . $firstName . ' is already added in this site!');
            $this->dispatchBrowserEvent('error-adding-employee-to-site');
        } else {
            $selectedEmployees = [
                $empId => $lastName . ' ' . $firstName
            ];

            $this->selectedEmployees += $selectedEmployees;
        }
    }

    public function removeFromSelection($key)
    {
        if ($key) {
            if (count($this->selectedEmployees) > 0) {
                unset($this->selectedEmployees[$key]);
            }
        }
    }

    public function saveSelectedEmployeesToWorkingSite()
    {
        $data = [];
        if (count($this->selectedEmployees) > 0) {
            foreach ($this->selectedEmployees as $key => $value) {
                $data[] = [
                    'employee_information_id' => $key,
                    'working_site_id' => $this->workingSiteId,
                    'created_at' => Carbon::now()
                ];
            }
        }

        if (count($data) > 0) {
            try {
                DB::table('employee_working_sites')->insert($data);

                $this->emit('reRenderParent');
                session()->flash('success', 'Selected employees added to this site successfully!');
                $this->reset(
                    'selectedEmployees',
                    'searchQueryString'
                );
            } catch (\Throwable $th) {
                //throw $th;
                dump('Something went wrong! - ' . $th);
            }
        }
    }

    public function render()
    {
        if ($this->searchQueryString) {
            $empInfo = EmployeeInformation::where('first_name', 'like', '%' . $this->searchQueryString . '%')
                ->orWhere('last_name', 'like', '%' . $this->searchQueryString . '%')
                ->get();
            $this->employees = $empInfo;
        }
        return view('livewire.payroll.working-site-management.modal-add-employee-to-site');
    }

    private function findEmployeeInWorkingSite($empId)
    {
        if ($empId && $this->workingSiteId) {
            $findEmpSite = EmployeeWorkingSite::where('employee_information_id', $empId)
                ->where('working_site_id', $this->workingSiteId)->get();
            return $findEmpSite->count() > 0 ? true : false;
        }
    }
}
