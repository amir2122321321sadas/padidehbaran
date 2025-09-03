<?php

namespace Modules\Frontend\Livewire\Client\Pages\Profile;

use App\Models\InsurancePolicy;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

class InsurancePoliciesProfilePage extends Component
{


    #[Title('بیمه نامه ها')]
    public function render()
    {
        return view('frontend::livewire.client.pages.profile.insurance-policies-profile-page')
            ->extends('components.layouts.profile')
            ->section('content');
    }
}
