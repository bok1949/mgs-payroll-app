<?php

namespace App\Http\Livewire\Payroll\WorkingSiteManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Payroll\WorkingSite;
use App\Models\Payroll\EmployeeWorkingSite;

class WorkingSiteIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['reRenderParent'];

    public $searchString;

    public function reRenderParent()
    {
        $this->render();
    }

    public function openModalToUpdateSite($id, $siteName)
    {
        $this->emit('shownModalToUpdateWorkingSite', $id, $siteName);
    }

    public function openModalToDeleteSite($id, $siteName)
    {
        $this->emit('shownModalToDeleteWorkingSite', $id, $siteName);
    }

    public function openModalToAddEmployeeInSite($id, $siteName)
    {
        $this->emit('showModalToAddEmployeeInSite', $id, $siteName);
    }

    public function openModalToShowEmployeesInSite($id, $siteName)
    {
        $this->emit('showModalToShowEmployeesInSite', $id, $siteName);
    }

    public function render()
    {
        $workingSites = WorkingSite::orderby('working_sites.site_name', 'asc')
        ->select(
            'working_sites.id',
            'working_sites.site_name',
        );

        $workingSites->addSelect([
            'emp_count' => EmployeeWorkingSite::selectRaw('COUNT(employee_information_id)')
            ->whereColumn('working_site_id', 'working_sites.id')
            ->groupBy('working_site_id')
        ]);

        if (!empty($this->searchString)) {
            $workingSites->orWhere('working_sites.site_name', 'like', $this->searchString . "%");
        }

        $sites = $workingSites->paginate(25);
        
        return view('livewire.payroll.working-site-management.working-site-index', compact(
            'sites'
        ));
    }
}
