<?php

namespace App\Http\Livewire\Payroll\WorkingSiteManagement;

use Livewire\Component;
use Illuminate\Support\Carbon;
use App\Models\Payroll\WorkingSite;

class ModalUpdateSite extends Component
{
    protected $listeners = [
        'shownModalToUpdateWorkingSite',
    ];

    protected $rules = [
        'site_name' => 'required|min:2|max:224',
    ];

    public $siteName, $site_name, $siteId;

    public function cancelUpdate()
    {
        $this->emit('reRenderParent');
    }

    public function shownModalToUpdateWorkingSite($id, $siteName)
    {
        $workingSite = WorkingSite::where('id', $id)
            ->select('site_name')
            ->first();

        $this->siteName = $siteName;
        $this->siteId = $id;
        $this->site_name = $workingSite->site_name;
    }

    public function saveChanges()
    {
        $validatedData = $this->validate();
        $validatedData = array_merge($validatedData, ['updated_at' => Carbon::now()]);

        WorkingSite::where('id', $this->siteId)
            ->update($validatedData);

        $this->siteName = $this->site_name;
        session()->flash('message', 'Working site name is updated successfully!');

        $this->emit('reRenderParent');
    }

    public function render()
    {
        return view('livewire.payroll.working-site-management.modal-update-site');
    }
}
