<?php

namespace App\Http\Livewire\Payroll\WorkingSiteManagement;

use Livewire\Component;
use App\Models\Payroll\WorkingSite;
use App\Models\Payroll\EmployeeWorkingSite;

class ModalDeleteSite extends Component
{
    protected $listeners = [
        'shownModalToDeleteWorkingSite',
    ];

    public $siteName, $employeeCount, $siteId;
    public bool $loadData = false;
    public $deleteMessage;

    public function cancelDelete()
    {
        $this->emit('reRenderParent');
    }

    public function init()
    {
        sleep(3);
        $this->loadData = true;
    }

    public function shownModalToDeleteWorkingSite($siteId, $name)
    {
        $this->siteId = $siteId;
        $this->siteName = $name;

        $numberOfEmployees = EmployeeWorkingSite::where('working_site_id', $siteId)->count();
        $this->employeeCount = $numberOfEmployees;

        
        $this->deleteMessage = ($numberOfEmployees === 0) 
            ? "This action will removed site name <strong>" 
                . $this->siteName . "</strong> permanently."
                . "<br>Are you sure you want to continue this action?"
            : "The site name <strong>" . $this->siteName . "</strong> has <strong>" . $numberOfEmployees . "</strong> employees."
                . "<br>You cannot delete this site!";
        
    }

    public function confirmDelete()
    {
        $ws = WorkingSite::find($this->siteId);
        $ws->delete();

        $this->dispatchBrowserEvent('site-deleted', ['deleteMessage' => 'Working site is successfully deleted!']);
        $this->emit('reRenderParent');
    }

    public function render()
    {
        return view('livewire.payroll.working-site-management.modal-delete-site');
    }
}
