<?php

namespace Modules\Frontend\Livewire\Client\Items\Alert;

use Livewire\Component;

class AlertInActiveYourProfile extends Component
{
    public $activeUser;


    public function mount($activeUser)
    {
        $this->activeUser = $activeUser;
    }

    public function render()
    {
        return view('frontend::livewire.client.items.alert.alert-in-active-your-profile');
    }
}
