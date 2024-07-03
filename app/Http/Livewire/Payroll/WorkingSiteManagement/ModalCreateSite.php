<?php

namespace App\Http\Livewire\Payroll\WorkingSiteManagement;

use App\Models\Payroll\WorkingSite;
use Livewire\Component;
use Illuminate\Support\Carbon;

class ModalCreateSite extends Component
{

    protected $rules = [
        'site_name' => 'required|min:2|max:255',
    ];

    public $site_name, $siteNameValue;

    public function cancelCreate()
    {
        $this->emit('reRenderParent');
    }

    public function createSiteName()
    {
        $validatedData = $this->validate();
        $validatedData = array_merge($validatedData, ['created_at' => Carbon::now()]);

        WorkingSite::create($validatedData);
        $this->siteNameValue = $this->site_name;
        session()->flash('message', 'Working site name is created!');
        $this->reset(
            'site_name'
        );
    }

    public function render()
    {
        return view('livewire.payroll.working-site-management.modal-create-site');
    }
}
