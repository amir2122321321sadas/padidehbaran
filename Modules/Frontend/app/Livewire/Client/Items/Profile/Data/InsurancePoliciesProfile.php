<?php

namespace Modules\Frontend\Livewire\Client\Items\Profile\Data;

use Livewire\Component;

class InsurancePoliciesProfile extends Component
{
    public $insurancePolicies;

    public function mount()
    {
        $user = auth()->user();
        $this->insurancePolicies = $user->insurancePolicies;

    }

    public function render()
    {
        return view('frontend::livewire.client.items.profile.data.insurance-policies-profile');
    }
}
