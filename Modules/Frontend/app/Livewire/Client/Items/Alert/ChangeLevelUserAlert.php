<?php

namespace Modules\Frontend\Livewire\Client\Items\Alert;

use Livewire\Component;

class ChangeLevelUserAlert extends Component
{
    public $alert;
    public $show = true;

    public function mount($alert){
        $this->alert = $alert;
    }

    public function statusAlert()
    {
        $this->alert->update([
            'status' => 2
        ]);

        $this->show = false;
    }
    public function render()
    {
        return view('frontend::livewire.client.items.alert.change-level-user-alert');
    }
}
